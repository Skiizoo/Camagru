<?php
    require_once('scripts/specific/email.php');
?>

<link href="css/pages/email.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="form">
                    <form method="POST" action="/get_pwd">
                        <div class="row">
                            <div class="form-group">
                                <label>Réinitialiser ton mot de passe</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Votre adresse email" id="email" type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Envoyer le lien
                                </button>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
