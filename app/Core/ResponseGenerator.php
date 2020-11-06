<?php


namespace App\Core;


use App\Core\Http\Response\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ResponseGenerator
{
    private int $code;
    private array $headers;
    private string $body;
    private string $version = '1.1';
    private string $reason;


    public function __construct(
        int $code, array $headers,
        string $body, string $version,
        string $reason
    )
    {
        $this->code = $code;
        $this->headers = $headers;
        $this->body = $body;
        $this->version = $version;
        $this->reason = $reason;
    }

    public static function generate(ResponseInterface $response)
    {
        return new self(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getVersion(),
            $response->getReason()
        );
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if(! headers_sent()){
            header("HTTP/{$this->version} {$this->code} {$this->reason}", true, $this->code);
            header("X-Powered-By: {$_ENV['APP_NAME']}");
            foreach ($this->headers as $headerName => $headerValue){
                header("{$headerName}: {$headerValue}");
            }
        }

        return $this->body;
    }

    public function send(ServerRequestInterface $request)
    {
        echo $this->__invoke($request);
        exit($this->code);
    }
}