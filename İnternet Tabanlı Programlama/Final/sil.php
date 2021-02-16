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

if(isset($_GET["id"])){
    $silmeislemi=$_GET["id"];
    $silmodaci=$database->get ("385173_tbl_modaci","*",["id"=>$silmeislemi]);
    if ($silmodaci>0){
        $veri = $database->delete ("385173_tbl_modaci", ["id"=>$silmeislemi]);
        echo '<script>alert("kayıt silindi")</script>';
        header("Location:modaci.php");
    }
}

if(isset($_GET["id2"])){
    $silmeislemi2=$_GET["id2"];
    $sil2=$database->get ("385173_tbl_defile","*",["id"=>$silmeislemi2]);
    if ($sil2>0){
        $veri2 = $database->delete ("385173_tbl_defile", ["id"=>$silmeislemi2]);
        echo '<script>alert("kayıt silindi")</script>';
        header("Location:defile.php");
    }
}

?>

