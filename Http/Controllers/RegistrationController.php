<?php

namespace Http\Controllers;

class RegistrationController extends Controller
{
    public function create(): void
    {
        view('registration.create', ['form' => $this->form]);
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$this->form->validate(compact('email', 'password'))) {
            return $this->failForm('/register');
        }

        if (!! $this->db->query('SELECT * FROM users WHERE email=:email', ['email' => $email])->find()) {
            $this->form->setError('email', 'This email address is already in use.');
            return $this->failForm('/register');
        }

        $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        
        auth()->login(['email' => $email]);
        return redirect('/');
    }
}
