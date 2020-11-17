<?php


namespace App\Core;


use App\Core\Http\Response\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

class ResponseGenerator
{
    private int $code;
    private array $headers;
    private StreamInterface $body;
    private string $version = '1.1';
    private string $reason;


    public function __construct(
        int $code, array $headers,
        StreamInterface $body, string $version,
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
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    public function send(ServerRequestInterface $request)
    {
        echo $this->__invoke($request)->getContents();
        exit($this->code);
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if (!headers_sent()) {
            header("HTTP/{$this->version} {$this->code} {$this->reason}", true, $this->code);
            header("X-Powered-By: {$_ENV['APP_NAME']}");
            foreach ($this->headers as $headerName => $headerValues) {
                $headerValues = implode(' ', $headerValues);
                header("{$headerName}: {$headerValues}");
            }
        }

        return $this->body;
    }
}