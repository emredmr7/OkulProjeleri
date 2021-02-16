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
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
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
	<form action="" method="post">
		<div class="guncellemek2">
			Güncellenecek Değeri Giriniz<br>
			<input type="text" name="guncelleDefile"><br><br>
			<input type="submit" value="GÜNCELLE"><br><br>
			<a href="defile.php"> Sayfaya Dön</a>
		</div>
	</form>
</body>
</html>

<?php


$defile_ad="";
if(isset($_POST["guncelleDefile"])){
    if($_POST["guncelleDefile"] !=""){
        $defile_ad=$_POST["guncelleDefile"];
        $veri2 = $database->update ("385173_tbl_defile",["defile"=>$defile_ad],["id"=>$_GET["defile"]]);
        echo '<script>alert("kayıt Güncellendi")</script>';
	}else{
		echo '<script>alert("Lütfen Boş Alan Bırakmayınız.")</script>';
	}
}
?>