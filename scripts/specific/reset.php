<?php

    require_once('scripts/user.php');
    require_once('scripts/database.php');
    require_once('config/setup.php');

    if (!empty($_GET))
        if (isset($_GET['key'])) {
            if (!selectFirst($db, 'user', array('tokenLost' => $_GET['key'])))
                header('Location: /');
            $_SESSION['tokenLost'] = $_GET['key'];
        }
    
    if (!empty($_POST))
        if (!$error['password'] = checkPassword($_POST['password'], $_POST['password_confirmation']))
            if (changePassword($db, 'tokenLost', $_GET['key'], $_POST['password'])) {
                $success = "Ton mot de passe a bien été modifié";
                header('refresh:3;url=/login');
            }