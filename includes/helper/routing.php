<?php
/**
 * @var array<string> $routes
 */
$routes = [];

if (!function_exists('route_get')) {
    /**
     * Defines a GET route.
     *
     * @param string $segment The URL segment for the route.
     * @param string|null $view The view to load when the route is matched.
     */
    function route_get($segment, $view = null)
    {
        global $routes;
        $routes['GET'][] = [
            'view' => $view,
            'segment' => '/' . public_() . '/' . ltrim($segment, '/')
        ];
    }
}

if (!function_exists('route_post')) {
    /**
     * Defines a POST route.
     *
     * @param string $segment The URL segment for the route.
     * @param string|null $view The view to load when the route is matched.
     */
    function route_post($segment, $view = null)
    {
        global $routes;
        $routes['POST'][] = [
            'view' => $view,
            'segment' => '/' . public_() . '/' . ltrim($segment, '/')
        ];
    }
}


if (!function_exists('route_init')) {
    /**
     * Initializes the routing system and handles incoming requests.
     */
    function route_init()
    {
        global $routes;
        $GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
        $POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];
        if (!isset($_POST['_method'])) {
            foreach ($GET_ROUTES as $rget) {
                if (segment() == $rget['segment']) {
                    view($rget['view']);
                }
            }
        }

        if (isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 && strtolower($_POST['_method']) == 'post') {
            foreach ($POST_ROUTES as $rpost) {
                if (segment() == $rpost['segment']) {
                    view($rpost['view']);
                }
            }

            if (
                !is_null(segment()) && !in_array(
                    segment(),
                    array_column($POST_ROUTES, 'segment')
                )
            ) {
                view('404');
                exit();
            }

        }
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirects the user to a specified URL.
     *
     * @param string $check_path The URL path to redirect to.
     */
    function redirect($path)
    {
        $check_path = parse_url($path);
        if (isset($check_path['scheme']) && isset($check_path['host'])) {
            header("Location: " . $path);

        } else {
            header("Location: " . url($path));
        }
        // exit();


    }
}



if (!function_exists('redirect_if')) {
    /**
     * Redirect if the user to a specified URL.
     *
     * @param string $check_path The URL path to redirect to.
     */
    function redirect_if(bool $statement, string $url)
    {
        if ($statement) {
            redirect($url);
        }
    }
}

if (!function_exists('back')) {
    /**
     * back to previous page
     *
     */
    function back()
    {

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}


if (!function_exists('url')) {
    /**
     * Generates a full URL from a segment.
     *
     * @param string $segment The URL segment.
     * @return string The full URL.
     */
    function url($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

        return $url . $_SERVER['HTTP_HOST'] . '/' . public_() . '/' . ltrim($segment, '/');
    }
}

if (!function_exists('aUrl')) {
    /**
     * Generates admin URL from a segment.
     *
     * @param string $segment The URL segment.
     * @return string The full URL.
     */
    function aUrl($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

        return $url . $_SERVER['HTTP_HOST'] . '/' . public_() . '/' . ADMIN . "/" . ltrim($segment, '/');
    }
}


if (!function_exists('segment')) {
    /**
     * Retrieves the current URL segment.
     *
     * @return string The current URL segment.
     */
    function segment()
    {
        $segment = ltrim($_SERVER['REQUEST_URI'], '/');
        $removeQueryPram = explode('?', $segment)[0];
        return !empty($segment) ? '/' . $removeQueryPram : '/';
    }
}


if (!function_exists('checkRoute')) {
    /**
     * Return true if the current URL segment matches the given URL.
     *
     * @return string The current URL segment.
     */
    function checkRoute($url)
    {
        $url = removeCES($url);
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $full_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $full_url = removeCES($full_url);
        return $full_url === $url;
    }
}

if (!function_exists('removeCRU')) {
    /**
     * Remove the create, edit, and show segments from the URL.
     *
     * @param string $url The URL to modify.
     * @return string The modified URL.
     */
    function removeCES($url): string
    {
        $url = explode('/create', $url)[0];
        $url = explode('/edit', $url)[0];
        $url = explode('/show', $url)[0];
        return $url;
    }
}