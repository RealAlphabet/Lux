<?php

class Response
{
    private $headers;
    private $status;
    private $body;

    function __construct($body = '', $status = 200) {
        $this->headers     = (object) [];
        $this->status      = $status;
        $this->body        = $body;
    }

    function header($name, $value) {
        $this->headers->$name = $value;
        return $this;
    }

    function send() {
        $status     = $this->status;
        $headers    = $this->headers;
        $body       = $this->body;

        http_response_code($status);

        foreach ($headers as $name => $value) {
            header("$name: $value");
        }

        if (is_string($body)) {
            echo $body;

        } else {
            header('Content-Type: application/json');
            echo json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }
    }

    public static function redirect($location) {
        return (new Response())->header("Location", $location);
    }
}
