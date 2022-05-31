<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository 
{
    protected $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function getAllSkill()
    {
        return $this->skill->get();
    }
}