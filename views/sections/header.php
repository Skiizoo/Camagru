<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>Camagru - tbroggi</title>

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
    <link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sections/header.css' rel='stylesheet' type='text/css'>
    <link href='css/sections/footer.css' rel='stylesheet' type='text/css'>  
</head>
<body>
    <div class='container-fluid'>
        <header class='row'>
            <div class='col-l-4 col-m-12 col-s-12 logo'>
                <a class='title_camagru' href='/'>CAMAGRU</a>
            </div>
            <div class='col-l-4 col-m-8 col-s-12 menu'>
                <a href='/selfie'>Selfie</a>
            </div>
            <div class='col-l-4 col-m-4 col-s-12 login'>
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] != '') echo '<a href=\'/account\'>Compte</a> | <a href=\'/logout\'>Déconnexion</a>';
                      else echo '<a href=\'/register\'>Inscription</a> | <a href=\'/login\'>Connexion</a>'; ?>
            </div>
        </header>
