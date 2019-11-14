<?php

namespace App\Http\Resources\Skills;

use App\Http\Helpers\AppHelper;
use App\Http\Models\Skill\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class SkillsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $current_date = Carbon::today()->format('Y-m-d');
//        $current_date_start = $current_date->startOfDay();
//        $current_date_end = $current_date->endOfDay();
//        var_dump($current_date_start);
        $skills = Skill::where('user_id',Auth::user()['id'])
            ->with(['points'=>function($query) use ($current_date){
                $query->with(['value'=>function($q) use ($current_date){
                    $q->where('date',$current_date);
                }]);
            }])
            ->get()
            ->toArray();
        foreach ($skills as &$skill){
            $skill['web_title'] = AppHelper::slug($skill['title']);
            $skill['date'] = $current_date;
        }
        return [
            'skills' => $skills,
        ];
    }
}
