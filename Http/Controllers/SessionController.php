<?php

namespace Http\Controllers;

use Http\Forms\LoginForm;

class SessionController
{
    public function create(): void
    {
        view('session.create');
    }

    public function store(): mixed
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $form = new LoginForm();

        if (!$form->validate($email, $password)) {
            return view('session.create', ['errors' => $form->errors()]);
        }
        if (!auth()->attempt($email, $password)) {
            $form->error('email', 'No matching account found for that email address and password.');
            return view('session.create', ['errors' => $form->errors()]);
        }
        return redirect('/');
    }

    public function destroy(): never
    {
        auth()->logout();
        redirect('/');
    }
}
