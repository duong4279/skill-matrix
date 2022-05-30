<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\Level;
use App\Models\SkillLevel;
use Carbon\Carbon;

class SkillLevelController extends Controller
{
    public function getData() {
        $users = User::all();
        $skills = Skill::all();
        $levels = Level::all();
        $skillLevel = SkillLevel::all();
        return view('skills-matrix.index', compact('users', 'skills', 'levels', 'skillLevel'));
    }

    public function create(Request $request) {
        
        $user_id = $request->user_id;
        $skill_id = $request->skill_id;
        $data = SkillLevel::where([
            ['user_id', $user_id],
            ['skill_id', $skill_id]
        ])->first();
        if($data) {
            $data->user_id = $request->user_id;
            $data->skill_id = $request->skill_id;
            $data->level_id = $request->level_id;
            $time = $request->date;
            $date = Carbon::createFromFormat('m/d/Y', $time)->format('Y-m-d');
            $data->date = $date;
            $data->save();
        } else {
            $skillLevel = new SkillLevel();
            $skillLevel->user_id = $request->user_id;
            $skillLevel->skill_id = $request->skill_id;
            $skillLevel->level_id = $request->level_id;
            $time = $request->date;
            $date = Carbon::createFromFormat('m/d/Y', $time)->format('Y-m-d');
            $skillLevel->date = $date;
            $skillLevel->save();
        }       
        return redirect('/skills-matrix');
        // dd($request->daterange);
    }
}
