<?php

if (!function_exists("config")) {
    /**
     * Retrieves a configuration value from a configuration file.
     *
     * @param string $key The configuration key (e.g., 'database.host' or 'app.name').
     * @return mixed The configuration value or null if not found.
     */
    function config(string $key)
    {
        $config = explode(".", $key);
        if (count($config) > 0) {
            $result = include base_path('config/' . $config[0] . '.php');
            return $result[$config[1]];
        }
        return null;
    }
}

if (!function_exists("base_path")) {
    /**
     * Returns the base path of the application.
     *
     * @param string $path The relative path to append to the base path.
     * @return string The full path.
     */
    function base_path(string $path)
    {
        // echo getcwd(); // get the current working directory
        return getcwd() . '/../' . $path;
    }
}


if (!function_exists("public_path")) {
    /**
     * Returns the public path of the application.
     *
     * @param string $path The relative path to append to the public path.
     * @return string The full path.
     */
    function public_path(string $path)
    {
        return getcwd() . '/' . $path;
    }
}

if (!function_exists("public_")) {
    /**
     * Returns the public path of the application.
     *
     * @param string $path The relative path to append to the public path.
     * @return string The full path.
     */
    function public_()
    {
        return 'public';
    }
}