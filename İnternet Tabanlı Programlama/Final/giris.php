<?php
require 'Medoo.php';
session_start();
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'php_final',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODA</title>
    <style>
    body{
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: grey;
        height:584px;
        background-position: 50%;
        background-size:cover;
        background-attachment: fixed;
    }
    </style>
</head>
<body>
<div class="girisyap">
    <h2>GİRİŞ YAP SAYFASI</h2>
    <form action="" method="post">
        <div class="girdi">
            <span>E-Mail</span><br>
            <input type="email" name="ePosta"><br><br>
        </div>
        <div class="girdi">
            <span>Şifre</span><br>
            <input type="password" name="sifre"><br><br>
        </div>
        <div class="girdi">
            <input type="submit" value="Giriş Yap"><br><br>
        </div>
    </form>
    <a href="kayit.php">Kayıt Ol</a><br>
    <a href="hatirlat.php">Şifremi unuttum</a>
</body>
</html>
<?php

error_reporting(0);
$sifre="";
$ePosta="";
if(isset($_POST["ePosta"]) && isset($_POST["sifre"])){
    if($_POST["ePosta"]!="" && $_POST["sifre"]!=""){
        $ePosta=$_POST["ePosta"];
        $sifre=$_POST["sifre"];
        $kullanici = $database->get("385173_tbl_kullanicilar", "*", ["AND" => ["ePosta" => $ePosta,"sifre"=>$sifre]]);
        if($kullanici['id'] != ""){
            //Kullanıcı giriş bilgileri doğru
            //şimdi hesap aktif mi ona bakalım
            if($kullanici['aktif_mi']==1){
                //hesap aktif
                //profil sayfasına yönlendirelim
                $_SESSION["kullaniciID"]=$kullanici['id'];
                header('Location: profil.php');
                exit;
            }else{
                //hesap aktif değil
                //kullanıcıya uyarı ver
                echo '<script>alert("Hesabınız henüz aktifleştirilmedi.")</script>';
            }
        }else{
            //kullanıcı giriş bilgileri hatalı ya da tutarsız
            //kullanıcıya bilgi ver ve tekrar denesin
            echo '<script>alert("E-Posta ve Şifre bilgileriniz eksik ya da hatalı. Lütfen Tekrar deneyiniz.")</script>';
        }       

    }else{
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
    }    
}
?>
