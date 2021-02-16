<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp_vt',
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
			background: #000000;
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
	<form action="" method="post">
	Sevdiğiniz Bir Modacının Adı?:<input type="text" name="modaci_adi" value=""> <br>
	Sevdiğiniz Bir Marka Adı?:<input type="text" name="marka_adi" value=""> <br>
	Defile İzlemeyi Sever Misiniz?:<input type="text" name="son_defile" value=""> <br>
	Ne Sıklıkla Alışveriş Yaparsınız?(Nadiren, Ortalama, Sıklıkla) : <input type="text" name="alisveris" value=""><br><br>
	<input type="submit" value="KAYDET"> <br><br><hr>
	</form>
<?php
$modaciAdi="";
$markaAdi="";
$sonDefile="";
$alisveris="";
if(isset($_POST["modaci_adi"])&& isset($_POST["marka_adi"])&& isset($_POST["son_defile"])&& isset($_POST["alisveris"])){
	$modaciAdi=$_POST["modaci_adi"];
	$markaAdi=$_POST["marka_adi"];
	$sonDefile=$_POST["son_defile"];
	$alisveris=$_POST["alisveris"];
	$database-> insert("tbl_385173", ["modaci_adi" => $modaciAdi,"marka_adi" => $markaAdi,"son_defile" => $sonDefile, "alisveris" => $alisveris]);
	$sonKayit=0;
	$sonKayit=$database->id();
	if($sonKayit>0){
		echo '<script>alert("Kayıt Başarılı");</script>';
	}else{
		echo'<script>alert("Hata!");</script>';
	}
}
?>
<table class="darkTable">
<thead>
	<tr>
		<th>Sıra</th>
		<th>Modacı</th>
		<th>Marka Adları</th>
		<th>Defile İzliyor Musunuz</th>
		<th>Alışveriş Yapma Sıklığı</th>
	</tr>
</thead>
<tbody>
<?php
$kayitlar = $database->select("tbl_385173","*");
$sira=1;
foreach($kayitlar as $kayit){
	echo "<tr>
		<td>$sira</td>
		<td>".$kayit["modaci_adi"]."</td>
		<td>".$kayit["marka_adi"]."</td>
		<td>".$kayit["son_defile"]."</td>
		<td>".$kayit["alisveris"]."</td>
	</tr>";
	$sira++;
}
?>
</tbody>
</table>
</body>
</html>