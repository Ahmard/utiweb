<?php


namespace App;


use Psr\Http\Message\ServerRequestInterface;
use stdClass;

class Statistic
{
    private static self $instance;

    private string $filePath;

    private stdClass $statistic;

    private ServerRequestInterface $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
        $this->filePath = storage_path('statistics.json');
        $jsonData = file_get_contents($this->filePath);
        $this->statistic = json_decode($jsonData) ?? (new stdClass());
    }

    public static function getInstance(ServerRequestInterface $request)
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($request);
        }

        return self::$instance;
    }

    public function addVisit()
    {
        if (!is_array($this->statistic->visits)) {
            $this->statistic->visits = [];
        }

        $this->statistic->visits[] = [
            'path' => $this->request->getUri()->getPath(),
            'time' => time(),
        ];
        return $this;
    }

    public function saveChanges()
    {
        $encodedContent = json_encode($this->statistic);
        file_put_contents($this->filePath, $encodedContent);
    }
}