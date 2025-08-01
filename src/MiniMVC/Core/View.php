<?php

declare(strict_types=1);

namespace MiniMVC\Core;

class View
{
    private \Smarty $smarty;

    public function __construct(
        string $templateDir = 'templates/',
        string $compileDir = 'templates/templates_c'
    ) {
        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir($templateDir);
        $this->smarty->setCompileDir($compileDir);
        $this->smarty->setCaching(\Smarty::CACHING_OFF);
    }

    public function render(string $template, array $data = []): string
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this->smarty->fetch($template . '.tpl');
    }
}
