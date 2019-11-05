<?php
namespace App\Http\Controllers\Skills;

use App\Http\Controllers\Controller;
use App\Http\Models\Skill\Skill;
use App\Http\Models\Skill\SkillsPoint;
use App\Http\Response\SuccessResponse;
use App\Http\Response\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{
    public function saveSkill(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:255',
            'icon' => 'required|string|min:1|max:255',
            'color' => 'required|string|min:1|max:255',
            'points.*.title' => 'required|string|min:1|max:255',
            'points.*.units' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}


        if ($check_title = $this->checkSkillTitle($request)){
            return ValidatorResponse::get($check_title);
        }

        $skill = Skill::create([
            'user_id'=>Auth::user()['id'],
            'title'=>$request->input('title'),
            'description'=>($request->input('description'))?$request->input('description'):'',
            'icon'=>$request->input('icon'),
            'color'=>$request->input('color'),
            'type'=>$request->input('type')
        ]);

        foreach ($request->input('points') as $point){
            SkillsPoint::create([
               'skill_id' => $skill['id'],
               'title' => $point['title'],
               'units' => $point['unitsType'],
            ]);
        }

        return new SuccessResponse();
    }

    public function checkTitle(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:1|max:255',
        ]);
        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}
        if ($check_title = $this->checkSkillTitle($request)){
            return ValidatorResponse::get($check_title);
        }
        return new SuccessResponse();
    }

    public function checkSkillTitle(Request $request){
        if (Skill::where('user_id',Auth::user()['id'])->where('title',$request->input('title'))->first()){
            return ['title'=>__('errors.title_busy')];
        }
        return false;
    }
}