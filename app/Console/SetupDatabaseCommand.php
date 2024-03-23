<?php

namespace App\Console;

use PDO;

class SetupDatabaseCommand
{
    public static function handle()
    {
        echo "Veritabanı oluşturulmaya başlanıyor...\n";

        // Kullanıcıdan gerekli bilgileri al
        $host = readline('Veritabanı Hostu (varsayılan: localhost): ') ?: 'localhost';
        $database = readline('Veritabanı Adı (varsayılan: slim-services): ') ?: 'slim-services';
        $username = readline('Veritabanı Kullanıcı Adı (varsayılan: root): ') ?: 'root';
        $password = readline('Veritabanı Kullanıcı Şifre: (varsayılan: boş): ') ?: '';
        $port = readline('Veritabanı Portu (varsayılan: 3306): ') ?: '3306';

        try {
            // MySQL'e bağlan
            $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Veritabanını oluştur
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database`");


            //create table..
            $pdo->exec("CREATE TABLE IF NOT EXISTS `$database`.`posts` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `userId` INT NOT NULL,
                `title` VARCHAR(255) NOT NULL,
                `body` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`));");

            $pdo->exec("CREATE TABLE IF NOT EXISTS `$database`.`comments` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `postId` INT,
                `name` VARCHAR(255) NOT NULL,
 `email` VARCHAR(255) NOT NULL,
     `body` TEXT NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`postId`) REFERENCES `posts`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                PRIMARY KEY (`id`));");



            echo "Veritabanı '$database' başarıyla oluşturuldu.\n";

        } catch(PDOException $e) {
            echo "Veritabanı oluşturma başarısız: " . $e->getMessage() . "\n";
            exit(1);
        }

        // Settings.php dosyasını oluştur
        $settings = "<?php\n\n";
        $settings .= "return [\n";
        $settings .= "    'settings' => [\n";
        $settings .= "        'db' => [\n";
        $settings .= "            'host' => '$host',\n";
        $settings .= "            'database' => '$database',\n";
        $settings .= "            'username' => '$username',\n";
        $settings .= "            'password' => '$password',\n";
        $settings .= "            'port' => '$port'\n";
        $settings .= "        ]\n";
        $settings .= "    ]\n";
        $settings .= "];\n";

        file_put_contents('./src/settings.php', $settings);

        echo "Veritabanı Ayarları Kaydedildi. (/src/settings.php).\n";
        echo "Veritabanı kurulumu tamamlandı.\n";
    }
}
