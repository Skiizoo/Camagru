<?php

    if (!(isset($_SESSION) && $_SESSION['user'] != '' && $_SESSION['id_user'] != ''))
        header('Location: /');

    if (isset($_SESSION['user']) && !is_null($_SESSION['user'])) {
        session_destroy();
        header('Location: /');
    }