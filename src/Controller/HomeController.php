<?php

declare(strict_types=1);

namespace App\Controller;

class HomeController extends BaseController
{

    public function index(): void
    {
        $data = ['name' => 'mo', 'age' => 25];
        $this->render('home', $data);
    }
}