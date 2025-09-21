<?php
namespace App\Controllers;

use App\Models\IslanderModel;
use App\Models\CardModel;
use App\Models\SocialModel;
use CodeIgniter\Controller;

class IslanderController extends Controller
{
    public function index()
    {
        $islanderModel = new IslanderModel();
        $cardModel = new CardModel();
        $socialModel = new SocialModel();
        $userModel = new \App\Models\UserModel();

        $islanders = $islanderModel->findAll();
        $islanderCount = $islanderModel->countAllResults();
        $cardCount = $cardModel->countAllResults();
        $socialCount = $socialModel->countAllResults();
        $userCount = $userModel->countAllResults();

        return view('islanders/index', [
            'islanders' => $islanders,
            'islanderCount' => $islanderCount,
            'cardCount' => $cardCount,
            'socialCount' => $socialCount,
            'userCount' => $userCount,
        ]);
    }

    public function create()
    {
        return view('islanders/form');
    }

    public function store()
    {
        $islanderModel = new IslanderModel();
        $cardModel = new CardModel();
        $socialModel = new SocialModel();
        $data = $this->request->getPost();
        $uuid = function() {
            $data = random_bytes(16);
            $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // version 4
            $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // variant
            return vsprintf('%s%s%s%s-%s%s-%s%s-%s%s-%s%s%s%s%s%s', str_split(bin2hex($data), 2));
        };
        $token = $uuid() . '-' . substr($uuid(), 0, 32);
        $islanderData = [
            'full_name' => $data['full_name'],
            'token' => $token,
        ];
        $islanderModel->insert($islanderData);
        $islanderId = $islanderModel->getInsertID();
        // Assign card
        if (!empty($data['designation']) || !empty($data['email']) || !empty($data['phone'])) {
            $cardModel->where('islander_id', $islanderId)->delete(); // Remove old cards if any
            if (is_array($data['designation'])) {
                foreach ($data['designation'] as $i => $designation) {
                    if ($designation || ($data['email'][$i] ?? '') || ($data['phone'][$i] ?? '')) {
                        $cardModel->insert([
                            'islander_id' => $islanderId,
                            'designation' => $designation ?? '',
                            'email' => $data['email'][$i] ?? '',
                            'phone' => $data['phone'][$i] ?? '',
                            'theme' => $data['theme'][$i] ?? '',
                        ]);
                    }
                }
            } else {
                $cardModel->insert([
                    'islander_id' => $islanderId,
                    'designation' => $data['designation'] ?? '',
                    'email' => $data['email'] ?? '',
                    'phone' => $data['phone'] ?? '',
                    'theme' => $data['theme'] ?? '',
                ]);
            }
        }
        // Assign socials
        if (!empty($data['social_link'])) {
            foreach ($data['social_link'] as $i => $link) {
                if ($link) {
                    $cardId = isset($data['social_card'][$i]) && is_numeric($data['social_card'][$i]) ? (int)$data['social_card'][$i] : null;
                    $socialModel->insert([
                        'islander_id' => $islanderId,
                        'link' => $link,
                        'icon' => $data['social_icon'][$i] ?? '',
                        'card_id' => $cardId,
                    ]);
                }
            }
        }
        return redirect()->to('/islanders');
    }

    public function edit($id)
    {
        $islanderModel = new IslanderModel();
        $cardModel = new CardModel();
        $socialModel = new SocialModel();
        $islander = $islanderModel->find($id);
        $cards = $cardModel->where('islander_id', $id)->findAll();
        $socials = $socialModel->where('islander_id', $id)->findAll();
        return view('islanders/form', [
            'islander' => $islander,
            'cards' => $cards,
            'socials' => $socials,
        ]);
    }

    public function update($id)
    {
        $islanderModel = new IslanderModel();
        $cardModel = new CardModel();
        $socialModel = new SocialModel();
        $data = $this->request->getPost();
        $islanderModel->update($id, [
            'full_name' => $data['full_name'],
        ]);

        // Update cards: update existing, insert new, delete removed
        $existingCards = $cardModel->where('islander_id', $id)->findAll();
        $existingCardIds = array_map(function($c) { return $c['id']; }, $existingCards);
        $submittedCardIds = isset($data['card_id']) ? $data['card_id'] : [];
        $cardsToKeep = [];
        if (is_array($data['designation'])) {
            foreach ($data['designation'] as $i => $designation) {
                $cardId = isset($data['card_id'][$i]) && is_numeric($data['card_id'][$i]) ? (int)$data['card_id'][$i] : null;
                $cardData = [
                    'islander_id' => $id,
                    'designation' => $designation ?? '',
                    'email' => $data['email'][$i] ?? '',
                    'phone' => $data['phone'][$i] ?? '',
                    'theme' => $data['theme'][$i] ?? '',
                ];
                if ($cardId && in_array($cardId, $existingCardIds)) {
                    $cardModel->update($cardId, $cardData);
                    $cardsToKeep[] = $cardId;
                } else {
                    $newId = $cardModel->insert($cardData);
                    $cardsToKeep[] = $cardModel->getInsertID();
                }
            }
        } else {
            $cardData = [
                'islander_id' => $id,
                'designation' => $data['designation'] ?? '',
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'theme' => $data['theme'] ?? '',
            ];
            if (isset($data['card_id']) && is_numeric($data['card_id'])) {
                $cardModel->update((int)$data['card_id'], $cardData);
                $cardsToKeep[] = (int)$data['card_id'];
            } else {
                $newId = $cardModel->insert($cardData);
                $cardsToKeep[] = $cardModel->getInsertID();
            }
        }
        // Delete cards that were removed
        $cardsToDelete = array_diff($existingCardIds, $cardsToKeep);
        foreach ($cardsToDelete as $delId) {
            $cardModel->delete($delId);
        }

        // Update socials: update existing, insert new, delete removed
        $existingSocials = $socialModel->where('islander_id', $id)->findAll();
        $existingSocialIds = array_map(function($s) { return $s['id']; }, $existingSocials);
        $submittedSocialIds = isset($data['social_id']) ? $data['social_id'] : [];
        $socialsToKeep = [];
        if (!empty($data['social_link'])) {
            foreach ($data['social_link'] as $i => $link) {
                if ($link) {
                    $cardId = isset($data['social_card'][$i]) && is_numeric($data['social_card'][$i]) ? (int)$data['social_card'][$i] : null;
                    $socialId = isset($data['social_id'][$i]) && is_numeric($data['social_id'][$i]) ? (int)$data['social_id'][$i] : null;
                    $socialData = [
                        'islander_id' => $id,
                        'link' => $link,
                        'icon' => $data['social_icon'][$i] ?? '',
                        'card_id' => $cardId,
                    ];
                    if ($socialId && in_array($socialId, $existingSocialIds)) {
                        $socialModel->update($socialId, $socialData);
                        $socialsToKeep[] = $socialId;
                    } else {
                        $newId = $socialModel->insert($socialData);
                        $socialsToKeep[] = $socialModel->getInsertID();
                    }
                }
            }
        }
        // Delete socials that were removed
        $socialsToDelete = array_diff($existingSocialIds, $socialsToKeep);
        foreach ($socialsToDelete as $delId) {
            $socialModel->delete($delId);
        }
        return redirect()->to('/islanders');
    }

    public function delete($id)
    {
        $islanderModel = new IslanderModel();
        $islanderModel->delete($id);
        return redirect()->to('/islanders');
    }

    public function view($id)
    {
        $islanderModel = new IslanderModel();
        $cardModel = new CardModel();
        $socialModel = new SocialModel();
        $islander = $islanderModel->find($id);
        $card = $cardModel->where('islander_id', $id)->first();
        $socials = $socialModel->where('islander_id', $id)->findAll();
        return view('islanders/view', [
            'islander' => $islander,
            'card' => $card,
            'socials' => $socials,
        ]);
    }


        /**
     * Debug: Show columns for islanders, cards, socials tables
     */
    public function showTableColumns()
    {
        $db = \Config\Database::connect();
        $tables = ['islanders', 'cards', 'socials'];
        $result = [];
        foreach ($tables as $table) {
            $fields = $db->getFieldNames($table);
            $result[$table] = $fields;
        }
        header('Content-Type: text/plain');
        foreach ($result as $table => $fields) {
            echo "Table: $table\n";
            echo "Columns: " . implode(', ', $fields) . "\n\n";
        }
        exit;
    }
}
