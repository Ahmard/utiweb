<?php


namespace App\Core\Http\Response;


use Psr\Http\Message\ServerRequestInterface;

interface ResponseInterface extends \Psr\Http\Message\ResponseInterface
{
    public static function create(): self;

    /**
     * Use other response class instead
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function withResponse(self $response): ResponseInterface;

    /**
     * Send http response with view file
     * @param string $viewFile
     * @param array $viewData
     * @return $this
     */
    public function withView(string $viewFile, array $viewData = []): self;

    /**
     * Respond with json encoded data
     * @param array|object $arrayWithJson array or object
     * @return $this
     */
    public function withJson($arrayWithJson): self;

    /**
     * Check whether another response class is used
     * @return bool
     */
    public function hasResponse(): bool;

    /**
     * Check whether view file is used
     * @return bool
     */
    public function hasView(): bool;

    /**
     * Get http response view used
     * @return mixed
     */
    public function getView();

    /**
     * Get array|object provided with withBody() method
     * @return string
     */
    public function getJson(): string;

    /**
     * Get another response class used
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * Terminate request and respond with this class
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function send(ServerRequestInterface $request);
}