<?php


namespace App\Core\Http\View;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function load(string $viewFile, array $data = [])
    {
        if (!strpos($viewFile, '.twig')) {
            $viewFile .= '.twig';
        }

        $loader = new FilesystemLoader(view_path());
        $twig = new Environment($loader, [
            //'cache' => storage_path('cache'),
        ]);


        $twig->addGlobal('site', [
            'name' => $_ENV['APP_NAME'],
            'url' => $_ENV['APP_URL']
        ]);

        $template =  $twig->load($viewFile);

        return $template->render($data);
    }

    /**
     * @param string $viewFilePath
     * @return string
     * @throws Exception
     */
    public static function find(string $viewFilePath)
    {
        $viewFile = view_path($viewFilePath);

        if (file_exists($viewFile)) {
            return $viewFile;
        }
        throw new Exception("View file($viewFile) not found");
    }
}