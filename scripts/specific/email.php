<?php

    require_once('scripts/user.php');
    require_once('scripts/database.php');
    require_once('config/setup.php');

    if (!empty($_POST)) {
        if ($user = selectFirst($db, 'user', array('email' => $_POST['email']))) {
            $success = "Lien envoyé";
            $user['tokenLost'] = generateKey($user['email']);
            if ($id = store($db, 'user', $user) > 0) {
                $to = $user['email'];
                $subject = 'Réinitialisation mot de passe';
                $message = 'Bonjour ' . $user['pseudo'] . '<br><br>Pour réinitialiser ton mot de passe, clique sur ce lien : <a href="http://localhost:8008/reset_pwd?key=' . $user['tokenLost'] . '">https://camagru/reset_pwd?key=' . $user['tokenLost'] . '</a><br><br>A bientôt !';
                $headers = 'Content-type: text/html; charset=utf-8' . "\r\n" .
                'From: anthony.amsellem97@gmail.com' . "\r\n" .
                'Reply-To: anthony.amsellem97@gmail.com' . "\r\n" .
                'X-Mailer: PHP/';
                mail($to, $subject, $message, $headers);
            }
        } else
                $error['email'] = "Email inconnu";
    }