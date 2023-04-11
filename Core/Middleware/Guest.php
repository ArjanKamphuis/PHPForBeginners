<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if (loggedIn()) {
            redirect('/');
        }
    }    
}
