<?php


require_once(__DIR__.'/../config/config.php');

$app = new MyApp\Controller\PreUser();

$app->run();

?>
<!DOCTYPE html>
<html>
<head>
	<title>仮登録　完了</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="continer">
		<p class="err"><?= h($app->getErrors('email')); ?></p>
		<p>登録が完了しました。自動的にリダイレクトされます。</p>
		<p><a href="/index.php">リダイレクトされない場合はコチラをクリックしてください。</a></p>
	</div>
</body>
</html>
