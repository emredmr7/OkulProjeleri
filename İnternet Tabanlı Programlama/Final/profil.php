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
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);

if(!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"]==""){
    header('Location: giris.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODA</title>
    <style>
        body{
            background-color: grey;
        }
        h1{
            position: absolute;
            top: 100px;
            left: 500px;
        }
        h3{
            position: absolute;
            top : 180px;
            left : 500px
        }
    </style>
</head>
<body>
<?php
include('baglantilar.html');
?>
    <h1>Profil Sayfası</h1>
    <?php
    $kullanici = $database->get("385173_tbl_kullanicilar", "*", ["id" => $_SESSION["kullaniciID"]]);
    ?>
    <h3>Merhaba <?php echo $kullanici["adSoyad"]; ?></h3><br>
</body>
</html>