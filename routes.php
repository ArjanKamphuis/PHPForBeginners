<?php

use Controllers\NotesController;
use Controllers\RegistrationController;
use Controllers\SessionController;

$router->get('/', fn() => view('home', ['heading' => 'Home']));
$router->get('/about', fn() => view('home', ['heading' => 'About Us']));
$router->get('/contact', fn() => view('home', ['heading' => 'Contact Us']));

$router->get('/notes', [NotesController::class, 'index'])->only('auth');
$router->get('/note', [NotesController::class, 'show']);
$router->get('/notes/create', [NotesController::class, 'create']);
$router->post('/notes', [NotesController::class, 'store']);
$router->get('/note/edit', [NotesController::class, 'edit']);
$router->patch('/note', [NotesController::class, 'update']);
$router->delete('/note', [NotesController::class, 'destroy']);

$router->get('/register', [RegistrationController::class, 'create'])->only('guest');
$router->post('/register', [RegistrationController::class, 'store']);

$router->get('/login', [SessionController::class, 'create'])->only('guest');
$router->post('/session', [SessionController::class, 'store'])->only('guest');
$router->delete('/session', [SessionController::class, 'destroy'])->only('auth');
