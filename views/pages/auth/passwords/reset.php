<?php
    require_once('scripts/specific/reset.php');
?>

<link href="css/pages/reset.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="form">
                    <form method="POST" action="/reset_pwd?key=<?php echo $_GET['key']; ?>">
                        <div class="row">
                            <div class="form-group">
                                <label>Réinitialiser votre mot de passe</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Ton mot de passe" id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input placeholder="Confirmation du mot de passe" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="res-register">
                                <?php
                                if (isset($error) && empty($error['password']) && isset($success))
                                    echo "<span class='valid'>". $success . "</span>";
                                else if (!empty($error))
                                    foreach ($error as $e)
                                        echo "<span class='error'>$e</span><br>";
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Réinitialisation
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>