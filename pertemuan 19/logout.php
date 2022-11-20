<?php
session_start();
session_destroy();
$_SESSION = [];
setcookie('id','',time()-3000);
setcookie('key','',time()-3000);
header('Location: login.php');
exit;