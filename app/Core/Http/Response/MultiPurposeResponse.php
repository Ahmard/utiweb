<?php


namespace App\Core\Http\Response;


use Psr\Http\Message\StreamInterface;
use function request;

final class MultiPurposeResponse extends BaseResponse
{
    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        switch (true) {
            case request()->expectsJson():
                $this->withHeader('content-type', 'application/json');
                break;
            case request()->expectsHtml():
                $this->withHeader('content-type', 'text/html');
                break;
        }

        return parent::getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function getBody(): StreamInterface
    {
        //This method will be recursively called,
        //so we need to know when to quit.
        static $willReturn = false;
        if ($willReturn) {
            return parent::getBody();
        }

        switch (true) {
            case request()->expectsJson():
                $willReturn = true;
                return $this->writeBodyStream($this->getJson())->getBody();
            default:
                $willReturn = true;
                if ($this->hasView()) {
                    return $this->writeBodyStream($this->getView())->getBody();
                }

                return parent::getBody();
        }
    }
}