<?php

namespace Http\Controllers;

use Core\Controller;
use Core\Session;
use Http\Forms\LoginForm;

class SessionController extends Controller
{
    public function create(): void
    {
        view('session.create', ['errors' => Session::get('errors')]);
    }

    public function store()
    {
        $form = LoginForm::validate($attributes = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        if (!auth()->attempt($attributes['email'], $attributes['password'])) {
            $form->error('email', 'No matching account found for that email address and password.')->throw();
        }

        return redirect('/');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
