<?php

namespace App\Http\Resources\Skills;

use App\Http\Helpers\AppHelper;
use App\Http\Models\Skill\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class SkillsDataResource extends Resource
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
        $start_date = Carbon::now()->subDays(30)->format('Y-m-d');
        $skill = Skill::where('user_id',Auth::user()['id'])
            ->where('id',$request->input('skill_id'))
            ->with(['points'=>function($query) use ($current_date,$start_date){
                $query->with(['values'=>function($q) use ($current_date,$start_date){
                    $q->where('date','<=',$current_date);
                    $q->where('date','>=',$start_date);
                }]);
            }])
            ->first()
            ->toArray();
        if (isset($skill['points'])){
            foreach ($skill['points'] as &$point){
                if ($point['values']){
                    foreach ($point['values'] as $value){
                        $point['new_values'][$value['date']] = $value;
                    }
                }
            }
            unset($point);
            foreach ($skill['points'] as &$point) {
                if (isset($point['new_values'])){
                    foreach ($point['new_values'] as $key => $value) {
                        for ($i = 0; $i <= 27; $i++) {
                            $date = Carbon::now()->subDays($i)->format('Y-m-d');
                            if (!isset($point['new_values'][$date])) {
                                $point['new_values'][$date] = ['value'=>0];
                            }
                        }
                    }
                }else{
                    for ($i = 0; $i <= 27; $i++) {
                        $date = Carbon::now()->subDays($i)->format('Y-m-d');
                        if (!isset($point['new_values'][$date])) {
                            $point['new_values'][$date] = ['value'=>0];
                        }
                    }
                }
                ksort($point['new_values']);
            }
        }


        return [
            'skillData' => $skill,
        ];
    }
}
