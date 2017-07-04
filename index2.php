<?php

echo <<< EOT
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="main.js"></script>
	<title>四角と丸の判定サイト</title>

</head>

<body>
	<h1>四角と丸判定ページ</h1>
	<p>ここで書いた図形が四角か丸かを判断するページです。</p>
	<p><a href="./index.php">こちら</a>で判断するためのデータを収集しています。</p>
	<div id="aaa">
		<canvas id="canvas" width="300px" height="300px"></canvas>
	</div>
	<div id="item">
		<div id="item1">
			<p><button style="margin-bottom:10px;" id="undo">１つ前の状態に戻す</button></p>
			<p><button style="width:100px;" id="clear">消去</button></p>
		</div>
		<div id="item2">
			<form action="figurePredict.php" method="post">
				<input id="data" type="hidden" name="canvas_data">
				<input type="submit" value="判定" onclick="save()">
			</form>
		</div>
	</div>
</body>
</html>

EOT;

?>
