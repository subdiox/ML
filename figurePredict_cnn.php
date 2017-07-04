<?php
$canvas = $_POST["canvas_data"];

$canvas = preg_replace("/data:[^,]+,/i","",$canvas);
$canvas_decoded = base64_decode($canvas);
$image = imagecreatefromstring($canvas_decoded);
imagesavealpha($image, TRUE);

$filelist = scandir("./data/test/");
$count = count($filelist) - 1;
imagepng($image, './data/test/test'.strval($count).'.png');
$fullPath = 'convert ./data/test/test'.strval($count).'.png -background white -flatten -alpha off ./data/test/test'.strval($count).'.jpg && python3 ./cgi-bin/figure_predict_cnn.py ./data/test/test'.strval($count).'.jpg';

exec($fullPath, $outPara);

if ($outPara[0] == "0") {
	echo "四角<br>";
} else if($outPara[0] == "1") {
	echo "丸<br>";
}

echo strval($outPara[1]);

echo "<br><br><a href=./index3.php>前のページに戻る</a>";

exit;
?>
