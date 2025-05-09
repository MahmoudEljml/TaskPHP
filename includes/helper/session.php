<?php


if (!function_exists("session")) {
    /**
     * Manages session data, allowing to set, get and encrypt/decrypt.
     *
     * @param string $key The session key.
     * @param mixed|null $value The value to set in the session (optional).
     * @return mixed The session value or an empty string if not set.
     */
    function session(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : "";
    }
}

if (!function_exists("session_has")) {
    /**
     * Checks if a session key exists.
     *
     * @param string $key The session key to check.
     * @return bool True if the key exists, false otherwise.
     */
    function session_has(string $key): mixed
    {

        return isset($_SESSION[$key]);
    }
}
if (!function_exists("session_flash")) {
    /**
     * Manages flash session data (data that is only available for the next request).
     *
     * @param string $key The session key.
     * @param mixed|null $value The value to set in the flash session (optional).
     * @return mixed The flash session value or an empty string if not set.
     */
    function session_flash(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : "";
        session_forget($key);
        return $session;
    }
}


if (!function_exists("session_forget")) {
    /**
     * Removes a session key.
     *
     * @param string $key The session key to remove.
     */
    function session_forget(string $key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}

if (!function_exists("session_delete_all")) {
    /**
     * Destroy all session data.
     */
    function session_delete_all()
    {
        session_destroy();
    }
}
