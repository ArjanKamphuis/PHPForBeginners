<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        if (!auth()->loggedIn()) {
            redirect('/');
        }
    }
}
