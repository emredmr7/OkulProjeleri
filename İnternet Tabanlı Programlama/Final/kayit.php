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
<div class="kayitol">
    <h2>KAYIT OL SAYFASI</h2>
        <form action="eposta.php" method="post" enctype="multipart/form-data">
            <div class="girdi">
                <span>Ad Soyad</span><br>
                <input type="text" name="adSoyad"><br><br>
            </div>
            <div class="girdi">
                <span>E-Posta</span><br>
                <input type="email" name="ePosta"><br><br>
            </div>
            <div class="girdi">
                <span>Şifre</span><br>
                <input type="password" name="sifre"><br><br>
            </div>
            <div class="girdi">
                <span>Yüklenecek Fotoğrafı Seçiniz</span><br>
                <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            </div>
            <div class="girdi">
                <input type="submit" value="KAYIT OL"><br><br>
            </div>
            <a href="giris.php">Giriş Yap</a>
        </form>
</div>
</body>
</html>