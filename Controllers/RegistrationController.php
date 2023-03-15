<?php

namespace Controllers;

use Core\Validator;

class RegistrationController extends Controller
{
    public function create()
    {
        view('registration.create', ['errors' => $this->errors]);
    }

    public function store()
    {
        if (!$this->validate()) {
            return $this->create();
        }

        if (!! $this->db->query('SELECT * FROM users WHERE email=:email', ['email' => $_POST['email']])->find()) {
            $this->errors['email'] = 'This email address is already in use.';
            return $this->create();
        }

        $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);

        $_SESSION['user'] = [
            'email' => $_POST['email']
        ];

        redirect('/');
    }

    protected function validate(): bool
    {
        $this->errors = [];

        if (!Validator::email($_POST['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($_POST['password'], 7, 255)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        return empty($this->errors);
    }
}
