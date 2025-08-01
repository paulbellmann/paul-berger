<?php

declare(strict_types=1);

namespace MiniMVC\Core;

abstract class Controller
{
    protected Request $request;
    protected View $view;

    public function __construct(Request $request, View $view)
    {
        $this->request = $request;
        $this->view = $view;
    }

    protected function render(string $template, array $data = []): string
    {
        return $this->view->render($template, $data);
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
