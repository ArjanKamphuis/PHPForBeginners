<?php

namespace Http\Controllers;

use Http\Forms\RegistrationForm;

class RegistrationController extends Controller
{
    public function create()
    {
        view('registration.create', [
            'form' => RegistrationForm::resolve()
        ]);
    }

    public function store()
    {
        $form = new RegistrationForm();

        if (!$this->validate($form)) {
            $form->flash();
            return redirect('/register');
        }

        $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);
        
        auth()->login(['email' => $_POST['email']]);
        redirect('/');
    }

    protected function validate(RegistrationForm $form): bool
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$form->validate($email, $password)) {
            return false;
        }
        if (!! $this->db->query('SELECT * FROM users WHERE email=:email', ['email' => $email])->find()) {
            $form->setError('email', 'This email address is already in use.');
            return false;
        }

        return true;
    }
}
