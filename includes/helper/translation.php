<?php

if (!function_exists("trans")) {
    /**
     * Translates a string using the specified key and locale.
     *
     * @param string|null $key The translation key (e.g., 'messages.welcome').
     * @param string|null $default The default locale to use (optional).
     * @return string The translated string or an empty string if not found.
     */
    function trans(string $key = null, string $default = null): string
    {
        $trans = explode(".", $key);

        // Determine the locale to use.
        if (session_has('locale')) {
            $default = session('locale');
        } else {
            $default = !empty(config('lang.default')) ? config('lang.default') : config('lang.fallback');
        }

        // Construct the path to the translation file.
        $path = config('lang.path') . "/" . $default . "/" . $trans[0] . ".php";

        // Attempt to load the translation file and retrieve the string.
        if (file_exists($path) && count($trans) > 0) {  // Corrected condition to check for two parts of the key.
            $result = include $path;
            return isset($result[$trans[1]]) ? $result[$trans[1]] : $key;
        }
        return '';
    }
}



if (!function_exists("set_locale")) {
    /**
     * Sets the current locale in the session.
     *
     * @param string|null $lang The locale to set (e.g., 'en', 'ar').
     */
    function set_locale(string $lang = null)
    {
        session("locale", $lang);
    }
}

