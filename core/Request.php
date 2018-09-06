<?php

class Request
{
    protected $uri;
    protected $params = array();

    public static function uri()
    {
        $request = new self;
        return $request->stripParameters(trim($_SERVER['REQUEST_URI'], '/'));
    }

    protected function stripParameters($uri)
    {
        if (strpos($uri, '?') == true) {
            return substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }
}
