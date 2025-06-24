<?php

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
 
function route($action, Closure $callback)
{
    global $routes;
    $action = trim("/apps/networking".$action, '/');
    
    $action = preg_replace('/{[^}]+}\?/', '([^/]*)?' , $action);
    $action = preg_replace('/{[^}]+}/', '([^/]+)' , $action);
    
    $routes[$action] = $callback;
}

function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');
    
    $callback = null;
    $params = [];
    
    foreach ($routes as $route => $handler) {
        if(preg_match("%^{$route}$%", $action, $matches) === 1) {
            $callback = $handler;
            unset($matches[0]);
            $params = array_values($matches);
            break;
        }
    }

    if(!$callback || !is_callable($callback)) {
        http_response_code(404);
        echo "<script>window.open('/','_self')</script>";
        exit;
    }

    echo call_user_func($callback, ...$params);
}