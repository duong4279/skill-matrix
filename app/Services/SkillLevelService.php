<?php

namespace App\Services;

use App\Repositories\SkillLevelRepository;
use Exception;

class SkillLevelService 
{
    protected $skillLevelRepository;

    public function __construct(SkillLevelRepository $skillLevelRepository)
    {
        $this->skillLevelRepository = $skillLevelRepository;
    }

    public function getSkillLevel() 
    {
        return $this->skillLevelRepository->getAll();
    }

    public function createOrUpdate($data) 
    {
        try {
            $result = $this->skillLevelRepository->findData($data);
            if($result) {
                $this->skillLevelRepository->update($data);
                return redirect()->route('skill-matrix.index')->with(["message" => "Updated success"]);
            } else {
                $this->skillLevelRepository->save($data);
                return redirect()->route('skill-matrix.index')->with(["message" => "Created success"]);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}