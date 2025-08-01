<?php

declare(strict_types=1);

namespace MiniMVC\Core;

class Application
{
    private Router $router;
    private Request $request;
    private View $view;

    public function __construct(
        string $templateDir = '../templates/',
        string $compileDir = '../templates/templates_c/',
    ) {
        $this->router = new Router();
        $this->request = new Request();
        $this->view = new View($templateDir, $compileDir);
    }

    public function get(string $path, string $handler): void
    {
        $this->router->get($path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->router->post($path, $handler);
    }

    public function run(): void
    {
        try {
            echo $this->router->dispatch($this->request, $this->view);
        } catch (\Throwable $e) {
            $this->handleError($e);
        }
    }

    private function handleError(\Throwable $e): void
    {
        echo getenv('APP_DEBUG') . '##';
        if (getenv('APP_DEBUG')) {
            echo "Error: " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        } else {
            echo "Internal Server Error";
            echo "Error: " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        }
    }
}
