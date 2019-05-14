<?php

    require_once('scripts/user.php');
    require_once('scripts/database.php');
    require_once('config/setup.php');

    if (isset($_SESSION['id_user']) && isset($_SESSION['user']) && $_SESSION['user'] != '' && $_SESSION['user'] != '')
        header('Location: /');

    if (!empty($_GET)) {
        if (isset($_GET['key'])) {
            if (!selectFirst($db, 'user', array('tokenValidated' => $_GET['key'])))
                $error['tokenValidated'] = "Ce lien n'est plus valide";
            else if (validateEmail($db, $_GET['key'])) {
                $success = "Ton compte a été validé";
                header('refresh:3;url=/login');
            } else
                $error['tokenValidated'] = "Un erreur est survenue";
        }
    } else if (!empty($_POST)) {
        $error['pseudo'] = checkPseudo($db, $_POST['username']);
        $error['password'] = checkPassword($_POST['password'], $_POST['password_confirmation']);
        $error['email'] = checkEmail($db, $_POST['email']);
        foreach ($error as $e)
            if (!empty($e))
                return ($error);
        unset($error);
        $user['pseudo'] = $_POST['username'];
        $user['salt'] = generateSalt();
        $user['password'] = encrypt_password($_POST['password'] . $user['salt']);
        $user['email'] = $_POST['email'];
        $user['birthdate'] = $_POST['birthyear'] . '/' . $_POST['birthmonth'] . '/' . $_POST['birthday'];
        $user['dateCreated'] = date("Y-m-j H:i:s");
        $user['dateUpdated'] = date("Y-m-j H:i:s");
        $user['tokenValidated'] = generateKey($user['email']);
        if ($id = store($db, 'user', $user) > 0) {
            $to = $user['email'];
            $subject = 'Confirmation d\'inscription';
            $message = 'Bonjour ' . $user['pseudo'] . ',<br><br> Pour confirmer ton inscription, clique sur ce lien : <a href="http://localhost:8008/register?key=' . $user['tokenValidated'] . '">https://camagru/register?key=' . $user['tokenValidated'] . '</a><br><br>A bientôt !';
            $headers = 'Content-type: text/html; charset=utf-8' . "\r\n" .
                        'From: XXXXXX' . "\r\n" .
                        'Reply-To: XXXXXX' . "\r\n" .
                        'X-Mailer: PHP/';
            mail($to, $subject, $message, $headers);
            $success = "Compte enregistré. Tu vas recevoir un mail de confirmation";
        } else
            $error['registration'] = "Un erreur est survenue";
    }
