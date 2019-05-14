<?php

    require_once('scripts/database.php');
    require_once('config/setup.php');

    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == 'Envoyer' && isset($_POST['id_selfie']) && $_POST['id_selfie'] != '' && isset($_POST['comment']) && $_POST['comment'] != '' && isset($_POST['id_user']) && $_POST['id_user'] != '') {
            $value['id_user'] = $_SESSION['id_user'];
            $value['id_selfie'] = $_POST['id_selfie'];
            $value['message'] = $_POST['comment'];
            store($db, 'comment', $value);
            $user = selectFirst($db, 'user', array('id' => $_POST['id_user']));
            if (!$user['notification'])
                return ;
            $to = $user['email'];
            $subject = 'Nouveau commentaire sur un de vos selfies!';
            $message = 'Bonjour ' . $user['pseudo'] . '<br><br>Pour voir ce nouveau commentaire, clique sur ce lien : <a href=\'http://localhost:8008/\'>https://camagru.le-101.fr</a><br><br>A bientôt !';
            $headers = 'Content-type: text/html; charset=utf-8' . "\r\n" .
            'From: XXXXXX' . "\r\n" .
            'Reply-To: XXXXXX' . "\r\n" .
            'X-Mailer: PHP/';
            mail($to, $subject, $message, $headers);
        } else if ($_POST['submit'] == 'liked' && isset($_POST['id_selfie']) && $_POST['id_selfie'] != '' && isset($_POST['is_liked'])) {
            if (!$_POST['is_liked']) {
                $value['id_user'] = $_SESSION['id_user'];
                $value['id_selfie'] = $_POST['id_selfie'];
                store($db, 'likes', $value);
            } else {
                $id_like = selectFirst($db, 'likes', array('id_user' => $_SESSION['id_user'], 'id_selfie' => $_POST['id_selfie']))['id'];
                delete($db, 'likes', $id_like);
            }
        }
    }
?>
