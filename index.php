<?php

echo <<< EOT
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="main.js"></script>
	<title>データ収集サイト</title>
</head>

<body>
	<h1>図認識エンジン開発用データ収集サイト</h1>
	<p>初ゼミ（機械学習入門）で使用するデータを<br>収集することを目的として作られたサイトです。</p>
	<p>暇なときでいいので、枠の中に四角or丸を書いてください！<br>お願いします！<(_ _)></p>
	<p>収集したデータを用いて四角と丸を判別するページを作りました！<br><a href="./index2.php">こちら</a>がCNNを用いないバージョン</a><br><a href="./index3.php">こちら</a>がCNNを用いたバージョン</p>
	<div id="aaa">
		<canvas id="canvas" width="300px" height="300px"></canvas>
	</div>
	<div id="item">
		<div id="item1">
			<p><button style="margin-bottom:10px;" id="undo">１つ前の状態に戻す</button></p>
			<p><button style="width:100px;" id="clear">消去</button></p>
		</div>
		<div id="item2">
			<form action="formAction.php" method="post">

EOT;
if (isset($_COOKIE['figure'])) {
	$figure = $_COOKIE['figure'];
} else {
	$figure = 'square';
}
print '<input name="figure" type="radio" value="square" ';
if ($figure == 'square') { print 'checked="checked" '; }
print '/>四角';
print '<input name="figure" type="radio" value="circle" ';
if ($figure == 'circle') { print 'checked="checked" '; }
print '/>丸';
print '<br>';

echo <<< EOT
				<input id="data" type="hidden" name="canvas_data">
				<input type="submit" value="保存" onclick="save()">
			</form>
		</div>
	</div>
</body>
</html>

EOT;

?>
