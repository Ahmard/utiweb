<?php


namespace App\Http\Controllers\Api\Others;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Uticlass\Others\FireFiles;

class FireFilesController extends Controller
{
    public function index(): ResponseInterface
    {
        $fileLink = FireFiles::init(Url::getParamUrl())->get();
        $expName = explode('/', $fileLink);
        $fileName = end($expName);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $fileLink
        ]);
    }
}