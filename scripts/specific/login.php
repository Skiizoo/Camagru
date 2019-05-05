<?php

    require_once('scripts/user.php');
    require_once('scripts/database.php');
    require_once('config/setup.php');

    if (isset($_SESSION['id_user']) && isset($_SESSION['user']) && $_SESSION['user'] != '' && $_SESSION['user'] != '')
        header('Location: /');

    if (!empty($_POST)) {
        if ($user = selectFirst($db, 'user', array('pseudo' => $_POST['username']))) {
            if ($user['password'] == encrypt_password($_POST['password'] . $user['salt'])) {
                if (is_null($user['tokenValidated'])) {
                    $_SESSION['user'] = $_POST['username'];
                    $_SESSION['id_user'] = $user['id'];
                    $success = "Connexion réussi";
                    header('refresh:2;url=/account');
                } else
                    $error['tokenValidated'] = "Vous devez confirmer votre email";
            } else
                $error['password'] = "Votre mot de passe ne correspond pas";
        } else
            $error['pseudo'] = "Pseudo inconnu";
    }