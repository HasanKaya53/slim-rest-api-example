<?php

namespace App\Console;

class ConsoleCommand
{
    public static function makeController($name)
    {
        $controllerName = ucwords($name) . 'Controller';
        $filePath = './app/Controller/' . $controllerName . '.php';

        if (file_exists($filePath)) {
            echo "Controller already exists!\n";
            return;
        }



        $content = "<?php

namespace App\Controller;

class $controllerName
{
    //
}
";

        file_put_contents($filePath, $content);
        echo "Controller oluşturuldu: $controllerName\n";
    }
}
