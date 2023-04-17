<?php

namespace Http\Controllers;

use Core\Session;
use Http\Forms\LoginForm;

class SessionController
{
    public function create(): void
    {
        view('session.create', [
            'errors' => Session::get('errors')
        ]);
    }

    public function store(): mixed
    {
        $form = new LoginForm();

        if (!$this->validate($form)) {
            Session::flash('errors', $form->errors());
            return redirect('/login');
        }

        return redirect('/');
    }

    public function destroy(): never
    {
        auth()->logout();
        redirect('/');
    }

    protected function validate(LoginForm $form): bool
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$form->validate($email, $password)) {
            return false;
        }
        if (!auth()->attempt($email, $password)) {
            $form->error('email', 'No matching account found for that email address and password.');
            return false;            
        }

        return true;
    }
}
