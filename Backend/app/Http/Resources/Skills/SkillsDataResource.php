<?php

namespace App\Http\Resources\Skills;

use App\Http\Helpers\AppHelper;
use App\Http\Models\Skill\Skill;
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
        $skills = Skill::where('user_id',Auth::user()['id'])->with('points')->get()->toArray();
        foreach ($skills as &$skill){
            $skill['web_title'] = AppHelper::slug($skill['title']);
        }
        return [
            'skillData' => $skills,
        ];
    }
}
