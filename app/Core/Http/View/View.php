<?php


namespace App\Core\Http\View;

use App\Core\Helpers\Classes\TwigSiteHelper;
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
        $twigOptions = [];

        if ($_ENV['APP_ENVIRONMENT'] == 'production') {
            $twigOptions['cache'] = storage_path('cache/twig');
        }

        $twig = new Environment($loader, $twigOptions);
        $twig->addGlobal('site', new TwigSiteHelper());
        $template = $twig->load($viewFile);

        return $template->render([
            'page' => $data
        ]);
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