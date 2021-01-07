<?php


namespace App;


use App\Core\Database;
use App\Core\Http\Router\Dispatcher;
use PDO;
use Psr\Http\Message\ServerRequestInterface;

class Statistic
{
    private static self $instance;

    private ServerRequestInterface $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    public static function getInstance(ServerRequestInterface $request): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($request);
        }

        return self::$instance;
    }

    public function get(int $limit = 0): array
    {
        $limitCondition = null;
        if (0 != $limit) {
            $limitCondition = " ORDER BY id DESC LIMIT {$limit}";
        }

        $query = Database::create()->query("SELECT * FROM statistics {$limitCondition}");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addVisit(): self
    {
        $dispatchResult = Dispatcher::getDispatchResult();
        $dispatchedRoute = $dispatchResult->getRoute();

        if (false !== strpos($dispatchedRoute->getName(), 'scrapper.extractor')) {
            $parameters = $dispatchResult->getUrlParameters();
            $parameters['url'] = base64_decode($parameters['url']);

            $query = Database::create()->prepare('INSERT INTO statistics(url, parameters, time) VALUES (:url, :parameters, :time)');
            $query->bindValue(':url', htmlspecialchars($this->request->getUri()->getPath()));
            $query->bindValue(':parameters', json_encode($parameters));
            $query->bindValue(':time', time());
            $query->execute();
        }

        return $this;
    }
}