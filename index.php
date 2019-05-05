<?php
    session_start();

    require_once('config/setup.php');
    require_once('views/sections/header.php');

    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
    switch ($request_uri[0]) {
        case '/':
            require 'views/pages/gallery.php';
            break;
        case '/selfie':
            require 'views/pages/selfie.php';
            break;
        case '/register':
            require 'views/pages/auth/register.php';
            break;
        case '/login':
            require 'views/pages/auth/login.php';
            break;
        case '/get_pwd':
            require 'views/pages/auth/passwords/email.php';
            break;
        case '/reset_pwd':
            require 'views/pages/auth/passwords/reset.php';
            break;
        case '/account':
            require 'views/pages/account.php';
            break;
        case '/logout':
            require 'scripts/specific/logout.php';
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            require 'views/pages/404.php';
            break;
    }

    require('views/sections/footer.php');