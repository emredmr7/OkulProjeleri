<?php
require 'Medoo.php';
 
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

if(isset($_GET["mail"]) && isset($_GET["kod"])){
    $mail=$_GET["mail"];
    $kod=$_GET["kod"];
    //Kayıt işlemi yapmalıyız
    $kullanici=$database->get("385173_tbl_kullanicilar","id", ["AND" =>["ePosta" => $mail, "aktivasyon" => $kod]]);
    if($kullanici>0){
        //aktivasyon yap
        $data = $database->update("385173_tbl_kullanicilar",["aktif_mi" => 1],["id" => $kullanici]);
        header('Location:profil.php');
    }else{
        header('Location:giris.php?m=kullanici_hata');
    }
}
?>