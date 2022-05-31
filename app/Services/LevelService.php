<?php
namespace App\Services;

use App\Repositories\LevelRepository;

class LevelService 
{
    protected $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    public function getAllLevel()
    {
        return $this->levelRepository->getAllLevel();
    }
}