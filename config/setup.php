<?php

    require_once('config/database.php');

    try {
        $db = new PDO($DB_DSN, $DB_USERNAME, $DB_PASSWORD);
        $sql = file_get_contents('config/struct.sql');
        $db->exec($sql);
        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        $sql = file_get_contents('config/content.sql');
        if (!$stmt->fetchAll())
            $db->exec($sql);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
