<?php


namespace App\Http\Controllers\Admin;


use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use DirectoryIterator;

class ErrorController extends Controller
{
    public function index(): ResponseInterface
    {
        $errorFiles = new DirectoryIterator(storage_path('logs/error'));
        $newErrorFiles = [];
        foreach ($errorFiles as $errorFile) {
            if (
                $errorFile->isFile() &&
                !$errorFile->isDot()
                && '.gitkeep' !== $errorFile->getFilename()
            ) {
                $errorData = json_decode(file_get_contents($errorFile->getRealPath()));
                $errorData->time = $errorFile->getCTime();
                $errorData->name = $errorFile->getFilename();
                $newErrorFiles[] = $errorData;
            }
        }

        return view('app/admin/error/index', [
            'errors' => $newErrorFiles
        ]);
    }
}