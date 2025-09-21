<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\VCardBuilder;
use CodeIgniter\HTTP\ResponseInterface;

class CardController extends BaseController
// ...existing code...
{
    private function resolveByToken(string $token)
    {
        $islanderModel = new \App\Models\IslanderModel();
        $cardModel = new \App\Models\CardModel();
        $socialModel = new \App\Models\SocialModel();
        $islander = $islanderModel->where('token', $token)->first();
        if (!$islander) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Card not found or expired');
        }
        $cards = $cardModel->where('islander_id', $islander['id'])->findAll();
        $socials = $socialModel->where('islander_id', $islander['id'])->findAll();
        // Attach cards and socials to islander object/array
        $islander['cards'] = $cards;
        $islander['socials'] = $socials;
        return $islander;
    }

    public function show($token)
    {
    $islander = $this->resolveByToken($token);
    // Always show all cards and socials/icons for the islander
    return view('card/show', ['islander' => $islander]);
    }

    public function vcard($token)
    {
        $islanderModel = new \App\Models\IslanderModel();
        $cardModel = new \App\Models\CardModel();
        $islander = $islanderModel->where('token', $token)->first();
        if (!$islander) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Card not found or expired');
        }
        $cards = $cardModel->where('islander_id', $islander['id'])->findAll();
        $fullName = $islander['full_name'] ?? '';
        $designations = [];
        $emails = [];
        $phones = [];
        foreach ($cards as $card) {
            if (!empty($card['designation']) && !in_array($card['designation'], $designations)) {
                $designations[] = $card['designation'];
            }
            if (!empty($card['email']) && !in_array($card['email'], $emails)) {
                $emails[] = $card['email'];
            }
            if (!empty($card['phone']) && !in_array($card['phone'], $phones)) {
                $phones[] = $card['phone'];
            }
        }
        $vcard = "BEGIN:VCARD\nVERSION:3.0\n";
        $vcard .= "FN:" . $fullName . "\n";
        foreach ($designations as $designation) {
            $vcard .= "TITLE:" . $designation . "\n";
        }
        foreach ($phones as $phone) {
            $vcard .= "TEL;TYPE=CELL:" . $phone . "\n";
        }
        foreach ($emails as $email) {
            $vcard .= "EMAIL;TYPE=INTERNET:" . $email . "\n";
        }
        $vcard .= "END:VCARD\n";
        return $this->response
            ->setHeader('Content-Type','text/vcard; charset=utf-8')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fullName . '.vcf"')
            ->setBody($vcard);
    }

    public function qr($token)
    {
        $user = $this->resolveByToken($token);
        $vcardUrl = base_url("card/{$token}/vcard.vcf");
        require_once(APPPATH . '../vendor/autoload.php');
        $options = new \chillerlan\QRCode\QROptions([
            'outputType' => \chillerlan\QRCode\QROptions::OUTPUT_IMAGE_PNG,
            'eccLevel'   => \chillerlan\QRCode\QRCode::ECC_L,
            'scale'      => 6,
        ]);
        $qrcode = new \chillerlan\QRCode\QRCode($options);
        $pngData = $qrcode->render($vcardUrl);
        return $this->response->setHeader('Content-Type', 'image/png')->setBody($pngData);
    }

    public function json($token)
    {
        $user = $this->resolveByToken($token);
        $data = [
            'name' => $user->username,
            'job_title' => $user->job_title,
            'company' => $user->company,
            'phone' => $user->phone,
            'email' => $user->email,
            'website' => $user->website,
            'location' => $user->location,
            'avatar_url' => base_url($user->avatar_path),
            'logo_url' => base_url($user->logo_path),
            'vcard_url' => base_url("card/{$token}/vcard.vcf"),
        ];
        return $this->response->setJSON($data);
    }
}
