<?php
    require_once('scripts/specific/login.php');
?>

<link href="css/pages/login.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="form">
                    <h2>Connectez-vous !</h2>
                    <form method="post" action="/login">
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Votre pseudo" id="username" type="text"
                                       class="form-control"
                                       name="username" value="" required autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="password" id="password" type="password"
                                       class="form-control"
                                       name="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (empty($error) && isset($success))
                                    echo "<span class='valid'>". $success . "</span>";
                                else if (!empty($error))
                                    foreach ($error as $e)
                                        echo "<span class='error'>$e</span><br>";
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit">Connexion</button>
                        </div>
                    </form>
                    <div class="footer"><a href="/get_pwd">Mot de passe oublié ?</a>
                    </div>
                    <div class="subscribe">
                        <h2>Pas encore de compte ?</h2>
                        <a href="/register">Inscrivez-vous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>