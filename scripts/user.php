<?php

    function checkPseudo($db, $username) {
        if (selectFirst($db, 'user', array('pseudo' => $username)))
            return 'Le pseudo existe déjà';
        if (!preg_match('/^([a-zA-Z0-9-_.]){3,20}$/', $username))
            return 'Le pseudo doit contenir 3 à 20 caractères alphanumériques';
        return;
    }

    function checkPassword($pwd, $pwd_conf) {
        if (strlen($pwd) < 5 || strlen($pwd) > 40)
            return 'Le mot de passe doit contenir 6 à 40 caractères';
        if ($pwd != $pwd_conf)
            return 'Les mots de passes ne correspondent pas';
        return;
    }

    function checkEmail($db, $mail) {
        if (selectFirst($db, 'user', array('email' => $mail)))
            return 'Un compte est déjà lié à cette adresse email';
        return;
    }

    function encrypt_password($password) {
        return hash('md5', $password);
    }

    function generateSalt() {
        $salt = "";
        $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        for ($i = 0; $i < 18; $i++)
            $salt .= $chaine[rand() % strlen($chaine)];
        return $salt;
    }

    function generateKey($email) {
        $key = "";
        $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        for ($i = 0; $i < 50; $i++)
            $key .= $chaine[rand() % strlen($chaine)];
        return $key . hash('md5', $email);
    }

    function validateEmail($db, $key) {
        if ($user = selectFirst($db, 'user', array('tokenValidated' => $key))) {
            $user['tokenValidated'] = NULL;
            $user['dateUpdated'] = date("Y-m-j H:i:s");
            store($db, 'user', $user);
            return (true);
        }
        return (false);
    }

    function changePassword($db, $field, $key, $pwd) {
        if ($user = selectFirst($db, 'user', array($field => $key))) {
            $user['salt'] = generateSalt();
            $user['password'] = encrypt_password($pwd . $user['salt']);
            $user['tokenLost'] = NULL;
            store($db, 'user', $user);
            return (true);
        }
        return (false);
    }