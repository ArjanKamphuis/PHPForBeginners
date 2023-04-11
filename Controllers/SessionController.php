<?php

namespace Controllers;

use Core\Validator;

class SessionController extends Controller
{
    public function create()
    {
        view('session.create', ['errors' => $this->errors]);
    }

    public function store()
    {
        if (!$this->validate()) {
            return $this->create();
        }

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', [':email' => $_POST['email']])->find();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            login($user);
            redirect('/');
        }

        $this->errors['email'] = 'No matching account found for that email address and password.';
        return $this->create();
    }

    public function destroy()
    {
        logout();
        redirect('/');
    }

    protected function validate(): bool
    {
        $this->errors = [];

        if (!Validator::email($_POST['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($_POST['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

        return empty($this->errors);
    }
}
