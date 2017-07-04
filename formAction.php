<?php
$canvas = $_POST["canvas_data"];
$shape_type = $_POST["figure"];

$canvas = preg_replace("/data:[^,]+,/i","",$canvas);

$canvas_decoded = base64_decode($canvas);

$image = imagecreatefromstring($canvas_decoded);
imagesavealpha($image, TRUE);

if ($shape_type == 'square') {
    $filelist = scandir("data/square/");
    $count = count($filelist) - 1;
    imagepng($image, 'data/square/square'.strval($count).'.png');
} else if ($shape_type == 'circle') {
    $filelist = scandir("data/circle/");
    $count = count($filelist) - 1;
    imagepng($image, 'data/circle/circle'.strval($count).'.png');
}
else {
	echo 'An error occurred.';
}

if (isset($_POST['figure'])) {
    setcookie('figure',$shape_type);
} else {
    setcookie('figure','square',time() + 60*60*24);
}
header( 'Location: ./index.php');
exit;
?>
