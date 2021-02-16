CREATE TABLE `php_final`.`385173_tbl_kullanicilar` ( `id` INT NOT NULL AUTO_INCREMENT , `adSoyad` VARCHAR(50) NOT NULL , `ePosta` VARCHAR(50) NOT NULL , `sifre` VARCHAR(50) NOT NULL , `foto` VARCHAR(300) NOT NULL , `aktif_mi` INT NOT NULL DEFAULT '0' , `aktivasyon` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `php_final`.`385173_tbl_defile` ( `id` INT NOT NULL AUTO_INCREMENT , `modaci_id` INT NOT NULL , `defile` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `php_final`.`385173_tbl_modaci` ( `id` INT NOT NULL AUTO_INCREMENT , `ad_soyad` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;