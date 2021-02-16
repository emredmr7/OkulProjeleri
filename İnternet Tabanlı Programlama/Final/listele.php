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
include('baglantilar.html');
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
        .listele{
            position: absolute;
            top : 100px;
            left : 500px
        }
        .listeleTablo{
            position: absolute;
            top : 250px;
            left : 470px
        }
        table.darkTable {
			font-family: "Arial Black", Gadget, sans-serif;
			border: 2px solid #000000;
			background-color: #4A4A4A;
			width: 100%;
			height: 200px;
			text-align: center;
			border-collapse: collapse;
		}
		table.darkTable td, table.darkTable th {
			border: 1px solid #4A4A4A;
			padding: 3px 2px;
		}
		table.darkTable tbody td {
			font-size: 13px;
			color: #E6E6E6;
		}
		table.darkTable tr:nth-child(even) {
			background: #888888;
		}
		table.darkTable thead {
			background: #ffffff;
			border-bottom: 3px solid #000000;
		}
		table.darkTable thead th {
			font-size: 15px;
			font-weight: bold;
			color: #E6E6E6;
			text-align: center;
			border-left: 2px solid #4A4A4A;
		}
		table.darkTable thead th:first-child {
			border-left: none;
		}

		table.darkTable tfoot td {
			font-size: 12px;
		}
    </style>
</head>
<body>
    <div class="listele">
        <form action="" method="post">
                <div class="secim">
                <label for="modacilar">Defilesi Olan Modacıyı Seçiniz</label><br>
                    <select id="modacilar" name="modaci">
                    <?php
                        $modacilar_ = $database -> select("385173_tbl_modaci","*");
                        foreach($modacilar_ as $modaci_){
                            echo "<option value='".$modaci_["id"]."'>".$modaci_["ad_soyad"]."</option>";
                        }
                    ?>
                    </select><br><br>
                </div>
            <input type="submit" value="Listele">
        </form>
    </div>
    <div class="listeleTablo">
        <table class="darkTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Modacı Ad Soyad</td>
                <td>Defile Adı</td>
            </tr>
            </thead>
            <tbody>
            <?php
            error_reporting(0);
            $defileler = $database -> select("385173_tbl_defile","*",["modaci_id" => $_POST["modaci"]]);
            foreach($defileler as $defile_ad){
                $modaci_ad = $database -> get("385173_tbl_modaci","*",["id" => $defile_ad["modaci_id"]]);
                echo "<tr>
                    <td>".$defile_ad["id"]."</td>
                    <td>".$modaci_ad["ad_soyad"]."</td>
                    <td>".$defile_ad["defile"]."</td>
                </tr>";
            }
            ?>
        </tbody>
        </table>
    </div>
</body>
</html>