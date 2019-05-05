<?php
    require_once('scripts/specific/account.php');
?>

<link href="css/pages/account.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="form">
                    <h2>Modification du pseudo</h2>
                    <form method="post" action="/account">
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Votre pseudo" id="username" type="text"
                                       class="form-control"
                                       name="username" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (empty($error['pseudo']) && !empty($success['pseudo']))
                                    echo "<span class='valid'>". $success['pseudo'] . "</span>";
                                else if (!empty($error['pseudo']) && isset($error['pseudo']))
                                    echo "<span class='error'>" . $error['pseudo'] . "</span><br>";
                                ?>
                            </div>
                        </div>
                        <div class="row submit-button">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                    <h2>Modification de l'email</h2>
                    <form method="post" action="/account">
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Votre adresse email" id="email" type="email"
                                       class="form-control"
                                       name="email" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (empty($error['email']) && !empty($success['email']))
                                    echo "<span class='valid'>". $success['email'] . "</span>";
                                else if (!empty($error['email']) && isset($error['email']))
                                    echo "<span class='error'>" . $error['email'] . "</span><br>";
                                ?>
                            </div>
                        </div>
                        <div class="row submit-button">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                    <h2>Modification du mot de passe</h2>
                    <form method="post" action="/account">
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Mot de passe" id="password" type="password"
                                       class="form-control"
                                       name="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Confirmez votre mot de passe" id="password-confirmation"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (empty($error['password']) && !empty($success['password']))
                                    echo "<span class='valid'>". $success['password'] . "</span>";
                                else if (!empty($error['password']) && isset($error['password']))
                                    echo "<span class='error'>" . $error['password'] . "</span><br>";
                                ?>
                            </div>
                        </div>
                        <div class="row submit-button">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                    <h2>Modification des préférences de notification</h2>
                    <form method="post" action="/account">
                        <div class="row">
                            <div class="form-group">
                                <input type="checkbox" id="mail_comments" name="mail_comments" value="mail_comments" <?php echo (selectFirst($db, 'user', array('id' => $_SESSION['id_user']))['notification'] == '1' ? 'checked' : '') ?>/>
                                <label for="mail_comments">Recevoir une notification email à chaque nouveau commentaire</label>
                                <input type='hidden' name='is_notif' value='is_notif'/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (!empty($success['notification']))
                                    echo "<span class='valid'>". $success['notification'] . "</span>";
                                ?>
                            </div>
                        </div>
                        <div class="row submit-button">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>