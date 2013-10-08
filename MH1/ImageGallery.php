<?php include 'TopPage.php';?>

<?php

	if (isset($_GET['img'])) {
		//Laver thumb nails
		if (file_exists($_GET['img'])){
			ignore_user_abort(true);
			set_time_limit(60);
			//Sletter måske det med memory
			ini_set('memory_limit', '512M');
			
			$src_size = getimagesize($_GET['img']);
			if ($src_size === false) {
				die('Er ikke et billed');
			}
		
			$thumb_width = 250;
			$thumb_height = 200;
		
			if ($src_size['mime' === 'image/jpeg']) {
				$src = imagecreatefromjpeg($_GET['img']);
			}else if ($src_size['mime' === 'image/png']){
				$src = imagecreatefrompng($_GET['img']);
			}else if ($src_size['mime' === 'image/gif']){
				$src = imagecreatefromgif($_GET['img']);
			}
		
			$src_aspect = round(($src_size[0] / $src_size[1]), 1);
			$thumb_aspect = round(($thumb_width / $thumb_height), 1);
		
			if ($src_aspect < $thumb_aspect) {
				//Højere
				$new_size = array($thumb_width,($thumb_width / $src_size[0]) * $src_size[1]);
				$src_pos = array(0, (($new_size[1] - $thumb_height) * ($src_size[1] / $new_size[1])) / 2);			
			}else if ($src_aspect > $thumb_aspect){
				//bredere
				$new_size = array(($thumb_width / $src_size[1])* $src_size[0], $thumb_height);
				$src_pos = array((($new_size[0] -$thumb_width) * ($src_size[0] / $new_size[0])) / 2, 0);
			}else{
				//Samme størrelse
				$new_size = array($thumb_width, $thumb_height);
				$new_size = array(0, 0);
			}
			if ($new_size[0] < 1) {
				$new_size[0] = 1;
			}
			if ($new_size[1] < 1) {
				$new_size[1] = 1;
			}
			$thumb = imagecreatetruecolor($thumb_width,$thumb_height);
			//Tager ti parametere(Hvor mange vil kopiere image til,)
			imagecopyresampled($thumb,$src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $src_size[0],$src_size[1]);
			
			
			if ($src_size['mime' === 'image/jpeg']) {
				imagejpeg($thumb, "images/thumbs/{$_GET['img']}");
			}else if ($src_size['mime' === 'image/png']){
				imagepng($thumb, "images/thumbs/{$_GET['img']}");
			}else if ($src_size['mime' === 'image/gif']){
				imagegif($thumb, "images/thumbs/{$_GET['img']}");
			}
			
			header("Location : images/thumbs/{$_GET['img']}");
		
		
		}
		die();
	}

//Tjekker om directory findes hvis ikke så laver vi et directory 
if (is_dir('images/thumbs') === false){
	mkdir('images/thumbs', 0744);
}
//Definere hvilke fil typer vi skal lede efter i i directory
$images = glob('*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
	
?>
  <div>
  <?php 
 
 
  foreach ($images as $image){
		if (file_exists("images/thumbs/{$image}")) {
			echo "<a href = \"{$image}\"><img src = \"images/thumbs/{$image}\" alt = \"{image}\" /></a>";                
		}else{
			echo "<a href = \"{$image}\"><img src = \"?img={$image}\" alt = \"{image}\" /></a>";
		}
	} 
  
  ?>
  
  
  
  </div>

<?php include 'BottomPage.php';?>