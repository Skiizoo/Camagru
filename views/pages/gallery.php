<?php
    require_once('scripts/specific/gallery.php');
?>

<link href='css/pages/gallery.css' rel='stylesheet' type='text/css'>

<div class='products'>
    <ul class='list-produits'>
		<?php
            $selfies = array_reverse(selectAll($db, 'selfie'));
            $nb_selfies = count($selfies);
			foreach ($selfies as $s) {
                $user = selectFirst($db, 'user', array('id' => $s['id_user']));
                $is_liked = isset($_SESSION['id_user']) ? selectFirst($db, 'likes', array('id_user' => $_SESSION['id_user'], 'id_selfie' => $s['id'])) : 0;
                $nb_likes = count(selectAll($db, 'likes', array('id_selfie' => $s['id'])));
                echo '<li class=\'li_list_gallery\'>
                        <figure>
                            <img class=\'img_list_gallery\' src=\'' . $s['src'] . '\' />
                            <figcaption class=\'caption\'>
                                <h4>' . $user['pseudo'] . ' - ' . (isset($_SESSION) && isset($_SESSION['user']) && isset($_SESSION['id_user']) ? '<form class=\'like_form\' action=\'/\' method=\'post\'>
                                <input type=\'hidden\' name=\'id_selfie\' value=\'' . $s['id'] . '\'/>
                                <input type=\'hidden\' name=\'is_liked\' value=\'' . ($is_liked ? '1' : '0') . '\'/>
                                <button type=\'submit\' name=\'submit\' value=\'liked\'>' : '') . 
                                ($is_liked ? '<i class=\'fas fa-heart\'></i>' : '<i class=\'far fa-heart\'></i>') .
                                '</button>
                                </form><span class=\'likes\'> ' . $nb_likes . '</span></h4>';
                                if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
                                    echo '<form class=\'comment_form\' action=\'/\' method=\'post\'>
                                    <input type=\'text\' name=\'comment\' value=\'\'/ placeholder=\'Ton message\'>
                                    <input type=\'hidden\' name=\'id_user\' value=\'' . $s['id_user'] . '\'/>
                                    <input type=\'hidden\' name=\'id_selfie\' value=\'' . $s['id'] . '\'/>
                                    <input type=\'submit\' name=\'submit\' value=\'Envoyer\'></form>';
                                }
                                $comments = selectAll($db, 'comment', array('id_selfie' => $s['id']));
                                foreach ($comments as $c) {
                                    $usr = selectFirst($db, 'user', array('id' => $c['id_user']));
                                    echo '<p class=\'user-comment\'><span class=\'name-user-comment\'>@' . $usr['pseudo'] . '</span> : ' . htmlspecialchars($c['message']) . '</p>';
                                }
                            echo '</figcaption>
                        </figure>
                </li> ';
            }
        ?>
    </ul>
    <ul id='ul_pagination'>
        <li class='li_pagination'><a class='a_pagination current' href='#'>1</a></li>
        <?php
            $nb_pages = round($nb_selfies / 6);
            for ($i = 2; $i <= $nb_pages; $i++)
                echo '<li class=\'li_pagination\'><a class=\'a_pagination\' href=\'#\'>' . $i . '</a></li>';
        ?>
    </ul>
</div>

<script type='text/javascript' src='js/gallery.js'></script>