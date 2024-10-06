<?php

declare(strict_types=1);

namespace App\Controller;

class BaseController
{
    protected function render(string $view, array $params = []): void
    {
        extract($params);
        require_once __DIR__ . "/../../templates/{$view}.php";
    }
}
