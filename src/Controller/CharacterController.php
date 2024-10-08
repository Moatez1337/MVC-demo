<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CharacterRepository;

class CharacterController extends BaseController{

    private CharacterRepository $characterRepository;
    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }
    public function index(): void
    {
        $data = $this->characterRepository->findAll();
        $this->render('character', ['data' => $data]);
    }
}