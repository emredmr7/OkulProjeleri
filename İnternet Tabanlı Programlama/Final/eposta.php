<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
//koşullar: daha önce yüklenmemiş olmalı, boyut max 10mb olmalı, dosya resim dosyası olmalı ve uzantı jpg, png ve gif olabilir

$hedef_klasor="img/";
$hedef_dosya= $hedef_klasor.basename($_FILES["fileToUpload"]["name"]);
$yuklemeyeUygunluk = 1;
$durum="";

//uygunluk kontrol dosya var mı
if(file_exists($hedef_dosya)){
    $yuklemeyeUygunluk=0;
    $durum.="Aynı dosya Var.";
}

//uygunluk kontrol boyut max 10mb mı (1 mb için x6 sıfır)
if($_FILES["fileToUpload"]["size"]>10000000){
    $yuklemeyeUygunluk=0;
    $durum.="Dosya boyutu 10MB üstünde.";
}

//dosya uzantı uygunluk
$resimDosyaTur = strtolower(pathinfo($hedef_dosya,PATHINFO_EXTENSION));
if($resimDosyaTur!="jpg" && $resimDosyaTur!="jpeg" && $resimDosyaTur!="png" && $resimDosyaTur!="gif"){
    $yuklemeyeUygunluk=0;
    $durum.="png, jpg, jpeg ve gif uzantılı olmalı.";
}

if($yuklemeyeUygunluk==1){
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $hedef_dosya)){
        if(isset($_POST["adSoyad"]) && isset($_POST["ePosta"]) && isset($_POST["sifre"])){
            if($_POST["adSoyad"] != "" && $_POST["ePosta"] != "" && $_POST["sifre"] != ""){
                $adSoyad=$_POST["adSoyad"];
                $ePosta=$_POST["ePosta"];
                $sifre=$_POST["sifre"];
                $kod_icin1 = date('d.m.Y H:i:s');
                $kod_icin2 = rand(0,20000);
                $aktivasyon_dkod = hash('sha256', $kod_icin2.$kod_icin1);
                
                //Kayıt işlemi yapmalıyız
                $database->insert("385173_tbl_kullanicilar", ["adSoyad" => $adSoyad,"ePosta" => $ePosta,"sifre" => $sifre, "foto" => $hedef_dosya, "aktivasyon" => $aktivasyon_dkod]);
                $yeni_kayit = $database->id();
                
                if($yeni_kayit>0){

                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;           
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                    
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'phpdenemeicin@gmail.com';                    
                        $mail->Password   = 'a1b2c3.d4e5';                             
                        $mail->SMTPSecure = 'tls';         
                        $mail->Port       = 587;                                    
                    
                        $mail->setFrom('phpdenemeicin@gmail.com', 'Php Mail Deneme');
                        $mail->addAddress($ePosta, 'Yeni Kullanıcı');
                        $mail->isHTML(true);                                 
                        $mail->Subject = 'Here is the subject';
                        $mail->Body    = 'Kayıt olduğunuz için teşekkürler, <br> Hesabınızı aktif etmek için <a href="localhost/385173/aktif_et.php?mail='.$ePosta.'&kod='.$aktivasyon_dkod.'"><b>tıklayınız</b>.</a>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        $mail->send();
                        echo '<script>alert("Doğrulama Linki Mail Adresinize Gönderdildi, Lütfen Kontrol Ediniz.")</script>';
                        
                    } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }else{
                    echo '<script>alert("Kayıt oluşturulurken hata!Lütfen tekrar deneyiniz.")</script>';
                }
            }else{
                echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.", "")</script>';
            }
        }
    }else {
        echo "Hata";
    }
}else{
    echo "Kriterler sağlanmadı!";
    echo $durum;
}
?>