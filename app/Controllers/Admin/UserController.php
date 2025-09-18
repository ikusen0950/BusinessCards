<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\tokens_helper;

class UserController extends BaseController
{
    /**
     * Generate a UUID v4 string
     */
    protected function generateUUID()
    {
        $data = random_bytes(16);
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // set version to 0100
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s%s%s-%s%s-%s%s-%s%s-%s%s%s%s%s%s', str_split(bin2hex($data), 2));
    }
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return view('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin/users/form');
    }

    public function store()
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();
        // Only keep allowed fields
        $fields = ['email', 'full_name', 'job_title', 'company', 'address', 'phone', 'website', 'card_theme', 'vcard_note', 'card_token', 'card_views'];
        $filtered = array_intersect_key($data, array_flip($fields));
        // Set username to full_name and password to Admin@123
        $filtered['username'] = $filtered['full_name'];
        $filtered['password_hash'] = password_hash('Admin@123', PASSWORD_DEFAULT);
        $user = new User($filtered);
        if (empty($user->card_token)) {
            $uuid = $this->generateUUID();
            $user->card_token = $uuid . '-' . $uuid;
        }
        if ($userModel->save($user)) {
            return redirect()->to('/admin/users')->with('success', 'User created');
        }
        return redirect()->back()->with('errors', $userModel->errors());
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        return view('admin/users/form', ['user' => $user]);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();
        // Debug: log incoming data and filtered fields
        log_message('debug', 'UserController update POST data: ' . json_encode($data));
        $fields = ['email', 'full_name', 'job_title', 'company', 'address', 'phone', 'website', 'card_theme', 'vcard_note', 'card_token',  'card_views'];
        $filtered = array_intersect_key($data, array_flip($fields));
        log_message('debug', 'UserController update filtered data: ' . json_encode($filtered));
        if (!empty($filtered)) {
            $filtered['id'] = $id;
            if ($userModel->update($id, $filtered)) {
                return redirect()->to('/admin/users')->with('success', 'User updated');
            } else {
                return redirect()->back()->with('errors', $userModel->errors());
            }
        }
        // No data to update, just redirect
        return redirect()->to('/admin/users')->with('success', 'User updated');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User deleted');
    }

    public function regenerateToken($id)
    {
        $userModel = new UserModel();
        $uuid = $this->generateUUID();
        $newToken = $uuid . '-' . $uuid;
        $userModel->update($id, ['card_token' => $newToken]);
        return redirect()->to('/admin/users')->with('success', 'Token regenerated');
    }

    public function upload($id)
    {
        // Handle avatar/logo upload logic here
        // ...
        return redirect()->to('/admin/users/edit/' . $id)->with('success', 'File uploaded');
    }
}
