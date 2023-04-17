<?php

namespace Http\Controllers;

class SessionController extends Controller
{
    public function create(): void
    {
        view('session.create', ['form' => $this->form]);
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$this->form->validate(compact('email', 'password'))) {
            return $this->failForm('/login');
        }

        if (!auth()->attempt($email, $password)) {
            $this->form->setError('email', 'No matching account found for that email address and password.');
            return $this->failForm('/login');            
        }

        return redirect('/');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
