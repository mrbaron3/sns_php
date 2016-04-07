<?php


require_once(__DIR__.'/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="continer">
		<form action="" method="post" id="login">
		<p><input type="text" name="email" placeholder="email"  value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>"></p>
		<p><input type="password" name="password" placeholder="password"></p>
		<p class="err"><?= h($app->getErrors('login')); ?></p>
		<div class="btn" onclick="document.getElementById('login').submit();">Log in</div>
		<p class="fs12"><a href="/signup.php">Sign up</a></p>
		<input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
		</form>
	</div>


</body>
</html>
