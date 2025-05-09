<?php

if (!function_exists("request")) {
    /**
     * 
     * request Used to get request data from $_GET or $_POST
     * @param string|null $request
     * @return mixed
     */
    function request(string $request = null)
    {
        if (isset($_FILES[$request]) && !empty($_FILES[$request])){
            return $_FILES[$request];
        }
        return isset($_REQUEST[$request]) ? $_REQUEST[$request] : null;
    }
}
