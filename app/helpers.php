<?php

if (!function_exists('is_active_link')) {
    /**
     * Check if the given route matches the current route and return 'active' if true.
     *
     * @param  string|array  $routes
     * @param  string  $class
     * @return string
     */
    function is_active_link($routes, $class = 'active')
    {
        if (is_array($routes)) {
            foreach ($routes as $route) {
                if (Route::is($route)) {
                    return $class;
                }
            }
        } else {
            if (Route::is($routes)) {
                return $class;
            }
        }

        return '';
    }
}
