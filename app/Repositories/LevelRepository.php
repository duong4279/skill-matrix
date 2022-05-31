<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository 
{
    protected $level;

    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    public function getAllLevel()
    {
        return $this->level->get();
    }
}