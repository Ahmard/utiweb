<?php


namespace App\Core\Http\View;

use App\Core\Helpers\Classes\TwigSiteHelper;
use App\Notification;
use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigFunction;

class View
{
    public static function load(string $viewFile, array $data = []): string
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
        $twig->addFilter(new TwigFilter('json_decode', function ($data){
            return json_decode($data);
        }));

        $twig->addFilter(new TwigFilter('to_array', function ($data){
            return (array)$data;
        }));

        $twig->addFunction(new TwigFunction('dump', function ($data){
            dump($data);
        }));

        $template = $twig->load($viewFile);

        $pageData = self::preparePageData($data);

        return $template->render([
            'page' => $pageData,
        ]);
    }

    /**
     * @param string $viewFilePath
     * @return string
     * @throws Exception
     */
    public static function find(string $viewFilePath): string
    {
        $viewFile = view_path($viewFilePath);

        if (file_exists($viewFile)) {
            return $viewFile;
        }
        throw new Exception("View file($viewFile) not found");
    }

    private static function preparePageData(array $data): array
    {
        return array_merge($data, [
            'notifications' => Notification::getAll(),
        ]);
    }
}