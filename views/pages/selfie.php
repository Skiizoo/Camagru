<?php
    require_once('scripts/specific/selfie.php');
?>

<link href='css/pages/selfie.css' rel='stylesheet' type='text/css'>

<div class='container'>
	<div class='row video'>
		<div class='row'>
			<video id='video'></video>
		</div>
		<div class='row'>
			<button id='picture_btn'>Prendre une photo</button>
		</div>
	</div>
    <div class='row justify-content-center'>
        <div class='col-md-6 col-md-offset-1'>
            <div class='card'>
				<canvas style='display: none' id='canvas'></canvas>
				<img id='selfie'>
				<form action='/selfie' method='post' enctype='multipart/form-data'>
					<div>
						<ul class='selection'>
							<li><img src='img/accessories/accessory1.png'><input type='radio' name='accessory' value='accessory1' onclick='EnableButton()'></li>
							<li><img src='img/accessories/accessory2.png'><input type='radio' name='accessory' value='accessory2' onclick='EnableButton()'></li>
							<li><img src='img/accessories/accessory3.png'><input type='radio' name='accessory' value='accessory3' onclick='EnableButton()'></li>
						</ul>
					</div>
					<div><input id='img' type='hidden' name='img'></div>
					<input id='uploadImage' type='file' name='image' onchange='PreviewImage();'>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
					<button id='btn-submit' type='submit' disabled='disabled'>Envoyer</button>
				</form>
			</div>
		</div>
		<div class='col-md-4' style='text-align: center;'>
			<div class='list-selfies'>
				<ul class='ul-list-selfies'>
				<?php
					$value['id_user'] = selectFirst($db, 'user', array('pseudo' => $_SESSION['user']))['id'];
					$selfies = selectAll($db, 'selfie', array('id_user' => $value['id_user']));
					foreach ($selfies as $s) {
						echo '<form action=\'/selfie\' method=\'post\'>
								<li class=\'li-list-selfie\'>
									<img class=\'img-list-selfie\' src=\'' . $s['src'] . '\'>
									<input type=\'hidden\' name=\'id_selfie\' value=\'' . $s['id'] . '\'/>
									<input type=\'hidden\' name=\'src_selfie\' value=\'' . $s['src'] . '\'/>
									<input type=\'submit\' name=\'submit\' value=\'Supprimer\'>
								</li>
							  </form>';
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type='text/javascript' src='js/selfie.js'></script>