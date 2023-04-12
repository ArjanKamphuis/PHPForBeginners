<?php

namespace Http\Controllers;

use Core\Validator;
use Http\Forms\LoginForm;

class SessionController extends Controller
{
    public function create()
    {
        view('session.create');
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $form = new LoginForm();

        if (!$form->validate($email, $password)) {
            return view('session.create', $form->errors());
        }

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', [':email' => $email])->find();

        if ($user && password_verify($password, $user['password'])) {
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
}
