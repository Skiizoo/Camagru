<?php

    if (!(isset($_SESSION) && $_SESSION['user'] != '' && $_SESSION['id_user'] != ''))
        header('Location: /');

    require_once('scripts/user.php');
    require_once('scripts/database.php');
    require_once('config/setup.php');
    
    if (!empty($_POST)) {
        if (isset($_POST['username'])) {
            if (empty($error['pseudo'] = checkPseudo($db, $_POST['username']))) {
                $user = selectFirst($db, 'user', array('id' => $_SESSION['id_user']));
                $user['pseudo'] = $_POST['username'];
                store($db, 'user', $user);
                $_SESSION['user'] = $user['pseudo'];
                $success['pseudo'] = "Ton pseudo a bien été modifié";
                header('refresh:3;url=/account');
            }
        } else if (isset($_POST['email'])) {
            if (empty($error['email'] = checkEmail($db, $_POST['email']))) {
                $user = selectFirst($db, 'user', array('id' => $_SESSION['id_user']));
                $user['email'] = $_POST['email'];
                store($db, 'user', $user);
                $success['email'] = "Ton email a bien été modifié";
                header('refresh:3;url=/account');
            }
        } else if (isset($_POST['password'])) {
            if (empty($error['password'] = checkPassword($_POST['password'], $_POST['password_confirmation']))) {
                changePassword($db, 'pseudo', $_SESSION['user'], $_POST['password']);
                $success['password'] = "Ton mot de passe a bien été modifié";
                header('refresh:3;url=/account');
            }
        } else if (isset($_POST['is_notif'])) {
            $user = selectFirst($db, 'user', array('id' => $_SESSION['id_user']));
            $user['notification'] = isset($_POST['mail_comments']) ? 1 : 0;
            store($db, 'user', $user);
            $success['notification'] = "Ta préférence a bien été modifié";
            header('refresh:3;url=/account');
        }
    }