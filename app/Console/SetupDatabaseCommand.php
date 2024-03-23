<?php

namespace App\Console;

class SetupDatabaseCommand
{
    public static function handle()
    {
        echo "Veritabanı oluşturulmaya başlanıyor...\n";

        // Kullanıcıdan gerekli bilgileri al
        $host = readline('Veritabanı Hostu (default: localhost): ') ?: 'localhost';
        $database = readline('Veritabanı Adı (default: slim-services): ')  ?: 'slim-services';
        $username = readline('Veritabanı Kullanıcı Adı (default: root): ') ?: 'root';
        $password = readline('Veritabanı Kullanıcı Şifre: (default:) ') ?: '';
        $port = readline('Veritabanı Portu (default 3306): ') ?: '3306';

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
