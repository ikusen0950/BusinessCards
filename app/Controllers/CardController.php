<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\VCardBuilder;
use CodeIgniter\HTTP\ResponseInterface;

class CardController extends BaseController
{
    private function resolveByToken(string $token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('card_token', $token)
            ->where('(card_token_expires_at IS NULL OR card_token_expires_at > NOW())')
            ->first();
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Card not found or expired');
        }
        return $user;
    }

    public function show($token)
    {
        $user = $this->resolveByToken($token);
        // Increment views and update last opened
        $userModel = new UserModel();
        $user->card_views = ($user->card_views ?? 0) + 1;
        $user->card_last_opened_at = date('Y-m-d H:i:s');
        $userModel->save($user);
        if (strtolower($user->card_theme) === 'finolhu') {
            return view('card/bc_finolhu', ['user' => $user]);
        }
        return view('card/show', ['user' => $user]);
    }

    public function vcard($token)
    {
        $user = $this->resolveByToken($token);
        $vcard = VCardBuilder::fromUser($user);
        return $this->response
            ->setHeader('Content-Type','text/vcard; charset=utf-8')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $user->username . '.vcf"')
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
