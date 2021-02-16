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
	'password' => ''
]);

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$ePosta="";
if(isset($_POST["ePosta"])){
        $ePosta=$_POST["ePosta"];
        //Kayıt işlemi yapmalıyız
        $sifre = $database->get("385173_tbl_kullanicilar","sifre",["ePosta" => $ePosta]);
        #try-catch
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
        
            //Recipients
            $mail->setFrom('phpdenemeicin@gmail.com', 'Php Mail Deneme');
            $mail->addAddress($ePosta, 'Yeni Kullanıcı');  
        
            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Şifre hatırlatma';
            $mail->Body    = '<h3>Unutulan şifreniz :'.$sifre.'</h3>';
        
            $mail->send();
            echo '<script>alert("Şifreniz Mail Adresinize Gönderildi.")</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }     
}
?>
<head>
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
<form action="" method="post">
    Mail Adresinizi Giriniz : <input type="email" name="ePosta"><br>
    <input type="submit" value="hatırlat"><br><br>
    <a href="giris.php">Giriş Yap Sayfasına Dön !</a>
</form>