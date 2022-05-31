<?php

namespace App\Repositories;

use App\Models\SkillLevel;
use Carbon\Carbon;

class SkillLevelRepository 
{
    protected $skillLevel;

    public function __construct(SkillLevel $skillLevel)
    {
        $this->skillLevel = $skillLevel;
    }

    public function getAll() 
    {
        return $this->skillLevel->get();
    }

    public function save($data)
    {
        $skillLevel = new $this->skillLevel;

        $skillLevel->user_id = $data->user_id;
        $skillLevel->skill_id = $data->skill_id;
        $skillLevel->level_id = $data->level_id;
        $time = $data->date;
        $date = Carbon::createFromFormat('m/d/Y', $time)->format('Y-m-d');
        $skillLevel->date = $date;

        $skillLevel->save();

        return $skillLevel->fresh();

    }

    public function update($data)
    {
        $user_id = $data->user_id;
        $skill_id = $data->skill_id;
        $skillLevel = $this->skillLevel->where([
            ['user_id', $user_id],
            ['skill_id', $skill_id]
        ])->first();
        $skillLevel->level_id= $data->level_id;
        $time = $data->date;
        $date = Carbon::createFromFormat('m/d/Y', $time)->format('Y-m-d');
        $skillLevel->date = $date;
        

        $skillLevel->update();
        return $skillLevel;
    }

    public function findData($data)
    {
        $user_id = $data->user_id;
        $skill_id = $data->skill_id;
        $result = $this->skillLevel->where([
            ['user_id', $user_id],
            ['skill_id', $skill_id]
        ])->first();

        return $result;
    }

}