<?php

namespace Framework;

use phpDocumentor\Reflection\Types\This;

class Response
{
    public int $responseCode;

    public string $body;

    public ?string $headers;

    public function __construct(int $responseCode, string $body, ?string $headers)
    {
        $this->responseCode = $responseCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function echo(): void
    {
        if ($this->headers  !== null) {
            header($this->headers);
            echo 'Headers is: ' .  $this->headers;
        }
         http_response_code($this->responseCode);
        echo 'Code is : ' . $this->responseCode;
        echo '<br>';
        echo 'Body is: ' .  $this->body;
        echo '<br>';
        echo 'Port is: ' . $_SERVER['SERVER_PORT'];
        echo '<br>';
//        echo var_dump($_SERVER);
    }
}
