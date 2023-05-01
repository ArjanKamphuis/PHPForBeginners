<?php

namespace Http\Controllers;

use Core\Session;
use Http\Forms\RegistrationForm;

class RegistrationController extends Controller
{
    public function create(): void
    {
        view('registration.create', ['errors' => Session::get('errors')]);
    }

    public function store()
    {
        $form = RegistrationForm::validate($attributes = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        if (!! $this->db->query('SELECT * FROM users WHERE email=:email', ['email' => $attributes['email']])->find()) {
            $form->error('email', 'This email address is already in use.')->throw();
        }

        $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $attributes['email'],
            'password' => password_hash($attributes['password'], PASSWORD_BCRYPT)
        ]);
        
        auth()->login(['email' => $attributes['email']]);
        return redirect('/');
    }
}
