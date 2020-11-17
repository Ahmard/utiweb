<?php


namespace App\Core\Http;

use App\Core\Http\Response\HtmlResponse;
use App\Core\Http\Response\InternalServerErrorResponse;
use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\MethodNotAllowedResponse;
use App\Core\Http\Response\NotFoundResponse;
use App\Core\Http\Response\RedirectResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Http\View\View;
use Laminas\Diactoros\Stream;
use Throwable;

/**
 * Class Response
 * @package App\HttpServer
 */
class Response
{
    protected int $statusCode = 200;

    protected array $headers = [];

    protected string $reason;

    protected string $version = '1.1';

    /**
     * Response constructor.
     * @param int $statusCode
     */
    public function __construct(int $statusCode = 200)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function headers(array $headers): Response
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * @param string $reason
     * @return $this
     */
    public function reason(string $reason): Response
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Set version
     * @param string $version
     * @return $this
     */
    public function version(string $version): Response
    {
        $this->$version = $version;
        return $this;
    }

    /**
     * Send 200 status response
     * @param string $body
     * @return ResponseInterface
     */
    public function ok(string $body): ResponseInterface
    {
        return $this->with(
            HtmlResponse::create()
                ->withBody(new Stream($body))
        );
    }

    /**
     * Send response with classes
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function with(ResponseInterface $response): ResponseInterface
    {
        if ($response->hasResponse()) {
            return $this->with($response->getResponse());
        }

        return $response;
    }

    /**
     * @param string $view
     * @param array $data
     * @return ResponseInterface
     */
    public function view(string $view, array $data = [])
    {
        return $this->with(HtmlResponse::create(View::load($view, $data)));
    }

    /**
     * Send 404 response
     * @return ResponseInterface
     */
    public function notFound()
    {
        return $this->with(NotFoundResponse::create());
    }

    /**
     * Send 500 response
     * @param string|null|Throwable $exception
     * @return ResponseInterface
     */
    public function internalServerError($exception = null)
    {
        return $this->with(InternalServerErrorResponse::create($exception));
    }

    public function methodNotAllowed()
    {
        return $this->with(MethodNotAllowedResponse::create());
    }

    /**
     * Redirect to new url
     * @param string $url
     * @return ResponseInterface
     */
    public function redirect(string $url)
    {
        return $this->with(RedirectResponse::create($url));
    }

    /**
     * @param mixed $body
     * @return ResponseInterface
     */
    public function json($body = [])
    {
        return $this->with(JsonResponse::create($body));
    }
}