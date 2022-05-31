<?php

namespace App\Services;

use App\Repositories\SkillRepository;

class SkillService 
{
    protected $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function getAllSkill()
    {
        return $this->skillRepository->getAllSkill();
    }
}