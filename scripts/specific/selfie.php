<?php

    if (!(isset($_SESSION) && $_SESSION['user'] != '' && $_SESSION['id_user'] != ''))
        header('Location: /');

    require_once('scripts/database.php');
    require_once('config/setup.php');

    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
        $cut = imagecreatetruecolor($src_w, $src_h); 
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
    }

    function generateName() {
        $key = "";
        $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        for ($i = 0; $i < 50; $i++)
            $key .= $chaine[rand() % strlen($chaine)];
        return $key;
    }

    if (isset($_POST['img']) && $_POST['img'] != "" && isset($_POST['accessory'])) {
        $data = base64_decode(explode(',', explode(';', $_POST['img'])[1])[1]);
        file_put_contents('img/tmp.png', $data);
        $selfie = imagecreatefrompng('img/tmp.png');
        if (!is_dir('img/' . $_SESSION['user']))
            mkdir('img/' . $_SESSION['user']);
        $accessory = imagecreatefrompng('img/accessories/' . $_POST['accessory'] . '.png');
        imagecopymerge_alpha($selfie, $accessory, 0, 0, 0, 0, imagesx($accessory), imagesy($accessory), 100);
        $img = generateName();
        $value['id_user'] = selectFirst($db, 'user', array('pseudo' => $_SESSION['user']))['id'];
        $value['src'] = 'img/' . $_SESSION['user'] . '/' . $img . '.png';
        imagepng($selfie, $value['src']);
        store($db, 'selfie', $value);
        unlink('img/tmp.png');
        imagedestroy($selfie);
    } else if (isset($_FILES['image']) && isset($_POST['accessory'])) {
        if (isset($_FILES['size']) && $_FILES['size'] < '1000000') {
            $image = $_FILES['image'];
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            if (in_array($extension, array('jpg', 'png'))) {
                $img = generateName();
                $value['id_user'] = selectFirst($db, 'user', array('pseudo' => $_SESSION['user']))['id'];
                $value['src'] = 'img/' . $_SESSION['user'] . '/' . $img . '.' . $extension;
                move_uploaded_file($image['tmp_name'], $value['src']);
                $selfie = $extension == 'jpg' ? imagecreatefromjpeg($value['src']) : imagecreatefrompng($value['src']);
                if (!is_dir('img/' . $_SESSION['user']))
                    mkdir('img/' . $_SESSION['user']);
                $accessory = imagecreatefrompng('img/accessories/' . $_POST['accessory'] . '.png');
                imagecopymerge_alpha($selfie, $accessory, 0, 0, 0, 0, imagesx($accessory), imagesy($accessory), 100);
                imagepng($selfie,  $value['src']);
                store($db, 'selfie', $value);
                imagedestroy($selfie);
            }
        }
    } else if (isset($_POST['id_selfie']) && $_POST['id_selfie'] != "" && isset($_POST['src_selfie']) && $_POST['src_selfie'] != "") {
        unlink($_POST['src_selfie']);
        delete($db, 'selfie', $_POST['id_selfie']);
    }