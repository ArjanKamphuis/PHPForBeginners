<?php

namespace Core;

class Authenticator
{
    protected array $user = [];

    public function __construct()
    {
        $this->user = $_SESSION['user'] ?? [];
    }

    public function attempt(string $email, string $password): bool
    {
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [':email' => $email])->find();

        if ($user && password_verify($password, $user['password'])) {
            $this->login($user);
            return true;
        }

        return false;
    }

    public function login(array $user): void
    {
        $this->user = $user;
        $_SESSION['user'] = $user;
        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    public function check(): bool
    {
        return !! ($_SESSION['user'] ?? false);
    }

    public function id(): int
    {
        return $this->check() ? $this->user['id'] : redirect('/login');
    }
}
