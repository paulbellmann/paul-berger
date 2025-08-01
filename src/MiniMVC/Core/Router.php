<?php

declare(strict_types=1);

namespace MiniMVC\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, string $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(Request $request, View $view): string
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $matchedRouted = $this->matchRoute($route['path'], $uri);

            if ($matchedRouted !== null) {
                return $this->callHandler($route['handler'], $request, $view, $matchedRouted);
            }
        }

        http_response_code(404);
        return 'Not Found';
    }

    private function matchRoute(string $pattern, string $uri): ?array
    {
        // Convert route pattern to regex
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $uri, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return null;
    }

    private function callHandler(string $handler, Request $request, View $view, array $params = []): string
    {
        if (!class_exists($handler)) {
            throw new \RuntimeException("Controller class not found: $handler");
        }

        $controller = new $handler($request, $view);

        if (!empty($params)) {
            return $controller->index(...array_values($params));
        }

        return $controller->index();
    }
}
