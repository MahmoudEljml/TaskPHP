<?php


if (!function_exists('bcrypt')) {
    function bcrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);

    }
}

if (!function_exists('bcrypt_check')) {
    function bcrypt_check(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}

// password_verify()