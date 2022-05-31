<?php

namespace App\Http\Controllers;

use App\Services\LevelService;
use App\Services\SkillService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Services\SkillLevelService;
use Exception;

class SkillLevelController extends Controller
{
    protected $skillLevelService;
    protected $skillService;
    protected $levelService;
    protected $userService;

    public function __construct(
        SkillLevelService $skillLevelService,
        SkillService $skillService,
        LevelService $levelService,
        UserService $userService,)
    {
        $this->skillLevelService = $skillLevelService;
        $this->skillService = $skillService;
        $this->levelService = $levelService;
        $this->userService = $userService;
    }

    public function createOrUpdate(Request $request)
    {

        $this->skillLevelService->createOrUpdate($request);
        return redirect('/skills-matrix/index');
    }

    public function index() 
    {
        try {
            $skillLevel = $this->skillLevelService->getSkillLevel();
            $skills = $this->skillService->getAllSkill();
            $levels = $this->levelService->getAllLevel();
            $users = $this->userService->getAllUser();
            
        } catch (Exception $e) {
            dd($e);
        }

        return view('skills-matrix.index', compact('users', 'skills', 'levels', 'skillLevel'));
    }
}
