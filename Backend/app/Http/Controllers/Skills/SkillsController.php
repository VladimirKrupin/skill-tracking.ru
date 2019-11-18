<?php
namespace App\Http\Controllers\Skills;

use App\Http\Controllers\Controller;
use App\Http\Models\Skill\Skill;
use App\Http\Models\Skill\SkillsPoint;
use App\Http\Models\Skill\SkillsPointsValue;
use App\Http\Resources\Skills\SkillPointsValuesByDateResource;
use App\Http\Response\SuccessResponse;
use App\Http\Response\ValidatorResponse;
use Carbon\Carbon;
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
            'edit' => 'required|bool',
            'points.*.title' => 'nullable|string|min:1|max:255',
            'points.*.units' => 'nullable|string|min:1|max:255',
        ]);
        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        if ($request->input('edit')){
            $skills = Skill::where('id',$request->input('id'))
                ->where('user_id',Auth::user()['id'])
                ->with('points')
                ->first();

            $skills->title = $request->input('title');
            $skills->description = ($request->input('description'))?$request->input('description'):'';
            $skills->icon = $request->input('icon');
            $skills->color = $request->input('color');
            $skills->type = $request->input('type');

            $skills->save();

            if ($request->input('points')){
                $points = $request->input('points');
                //change points
                foreach ($points as $point){
                    foreach ($skills->points as $skill_point){
                        if ($point['id'] === $skill_point['id']){
                            SkillsPoint::where('id', $point['id'])
                                ->update([
                                    'title' => $point['title'],
                                    'units' => $point['units'],
                                    'units_type' => $point['unitsType'],
                                ]);
                        }
                    }
                }
                //add new points
                foreach ($points as $point){
                    if ($point['id'] === 0){
                        SkillsPoint::create([
                            'skill_id' => $skills->id,
                            'title' => $point['title'],
                            'units' => $point['units'],
                            'units_type' => $point['unitsType'],
                            'active' => 1,
                        ]);
                    }
                }
                //remove points
                foreach ($skills->points as $skill_point){
                    $active = false;
                    foreach ($points as $point){
                        if ($skill_point['id'] === $point['id']){
                            $active = true;
                        }
                    }
                    if (!$active){
                        SkillsPoint::where('id', $skill_point['id'])
                            ->update([
                                'active' => 0,
                            ]);
                    }
                }
            }


//            //set inactive if new array not have point. and update if isset this.
//            foreach ($skills->points as &$skill_point){
//                $isset = false;
//                foreach ($request->input('points') as $point){
//                    if ($point['title']===$skill_point['title']){
//                        $skill_point->title = $point['title'];
//                        $skill_point->units = $point['units'];
//                        $skill_point->units_type = $point['unitsType'];
//                        $skill_point->active = 1;
//
//                    SkillsPoint::where('title', $point['title'])
//                        ->where('title', $point['title'])
//                        ->update([
//                        'title' => $point['title'],
//                        'units' => $point['units'],
//                        'units_type' => $point['unitsType'],
//                    ]);
//                    }
//                }
//                if (!$isset){
//                    $skill_point->active = 0;
//                }
//            }
//
//            //add new points
//            foreach ($request->input('points') as $new_point){
//                $isset = false;
//                foreach ($skills->points as $old_point){
//                    if ($old_point['title']!==$new_point){
//                        $isset = true;
//                    }
//                }
//                if (!$isset){
//                    SkillsPoint::create([
//                        'skill_id' => $skills->id,
//                        'title' => $new_point['title'],
//                        'units' => $new_point['units'],
//                        'units_type' => $new_point['unitsType'],
//                        'active' => 1,
//                    ]);
//                }
//            }


//            foreach ($request->input('points') as $point){
//                $point = SkillsPoint::where('title',$point['title'])->where('user_id',Auth::user()['id'])->first();
//                if ($point){
//                    $point->title = $point['title'];
//                    $point->units = $point['units'];
//                    $point->units_type = $point['unitsType'];
//                    $point->save();
//                }else {
//                    SkillsPoint::where('title', $point['title'])->update([
//                        'title' => $point['title'],
//                        'units' => $point['units'],
//                        'units_type' => $point['unitsType'],
//                    ]);
//                }
//            }
        }else{
            if ($check_title = $this->checkSkillTitle($request)){
                return ValidatorResponse::get($check_title);
            }
            $skill = Skill::create([
                'user_id'=>Auth::user()['id'],
                'title'=>$request->input('title'),
                'description'=>($request->input('description'))?$request->input('description'):'',
                'icon'=>$request->input('icon'),
                'color'=>$request->input('color'),
                'type'=>$request->input('type'),
                'active' => 1,
            ]);
            foreach ($request->input('points') as $point){
                SkillsPoint::create([
                    'skill_id' => $skill['id'],
                    'title' => $point['title'],
                    'units' => $point['units'],
                    'units_type' => $point['unitsType'],
                    'active' => 1,
                ]);
            }

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
    public function getPointsValuesByDate(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|min:1',
            'skill_id' => 'required|integer',
        ]);
        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

        if ($request->input('date') > Carbon::now()->format('Y-m-d')){return ValidatorResponse::get(['error'=>__('errors.date_big')]);}

        $date = $request->input('date');

        $points_values = Skill::where('user_id',Auth::user()['id'])->where('id',$request->input('skill_id'))
                            ->with(['points'=>function($query)use($date){
                                $query->with(['value'=>function($q)use($date){
                                    $q->where('date',$date);
                                }]);
                            }])
                            ->first();
        if ($points_values){
            return new SkillPointsValuesByDateResource($points_values);
        }else{
            return ValidatorResponse::get(['error'=>__('errors.data_not_found')]);
        }
    }
    public function sendSkillPointsValues(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'points.*.value' => 'nullable|integer|min:0|max:999',
            'points.*.hours' => 'nullable|integer|min:0|max:24',
            'points.*.minutes' => 'nullable|integer|min:0|max:60',
            'points.*.seconds' => 'nullable|integer|min:0|max:60',
        ]);

        if ($request->input('date') > Carbon::now()->format('Y-m-d')){return ValidatorResponse::get(['errors'=>['date'=>__('errors.date_big')]]);}

        if ($validator->fails()) {
            $error_str = '';
            foreach ($validator->errors()->all() as $error){
                $error_str .= ' '.$error;
            }
            return ValidatorResponse::get(['errors'=>['error' => "$error_str",'date' => false]]);
        }

        $date = $request->input('date');
        $skill = Skill::where('user_id',Auth::user()['id'])->where('id',$request->input('skill_id'))
            ->with(['points'=>function($query)use($date){
                $query->with(['value'=>function($q)use($date){
                    $q->where('date',$date);
                }]);
            }])
            ->first();

        var_dump($skill->toArray());
        var_dump($request->all());
        foreach ($skill->points as $skill_point){
            if ($skill_point['active'] === 1 && $skill_point['id']){

            }
            foreach ($request->input('points') as $point){

            }

        }
    }
}