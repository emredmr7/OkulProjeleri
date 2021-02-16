<?php
session_start();
$_SESSION["kullaniciID"]="";
header('Location: giris.php');
exit;
?>