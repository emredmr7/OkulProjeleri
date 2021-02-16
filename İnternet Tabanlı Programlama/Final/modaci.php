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
        .modaci{
            position: absolute;
            top : 100px;
            left : 500px
        }
        .tablo{
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
<?php
include('baglantilar.html');
?>

    <div class="modaci">
        <form action="" method="post">
            <span>Modacı Ad Soyad</span><br>
            <input type="text" name="modaciAd"><br><br>
            <input type="submit" value="Kaydet"><br><br>
        </form>
    </div>
    <div class="tablo">
        <table class="darkTable">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Modacı Ad Soyad</td>
                </tr>
            </thead>
            <tbody>
            <?php
            $modacilar = $database -> select("385173_tbl_modaci","*");
            $sira=1;
            foreach($modacilar as $modaci){
                echo "<tr>
                    <td>$sira</td>
                    <td>".$modaci["ad_soyad"]."</td>
                    <td><a href='sil.php?id=".$modaci['id']."'><button> SİL </button></a></td>
                    <td><a href='guncelle.php?ad_soyad=".$modaci['id']."'><button> GÜNCELLE </button></a></td>
                </tr>";
                $sira++;
                
            }
            ?>
        </tbody>
        </table>
    </div>
</body>
</html>
<?php
$adi="";
if(isset($_POST["modaciAd"])){
    if($_POST["modaciAd"]!=""){
        $adi=$_POST["modaciAd"];

        //Kayıt işlemi yapmalıyız
        $database->insert("385173_tbl_modaci", ["ad_soyad" => $adi]);
        $yeni_kayit = $database->id();
        if($yeni_kayit>0){
            echo '<script>alert("Modacı Eklendi, Defile Eklemeyi Unutmayın.")</script>';
        }else{
            echo '<script>alert("Kayıt oluşturulurken hata!Lütfen tekrar deneyiniz.")</script>';
        }
    }else{
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
    }    
}

?>