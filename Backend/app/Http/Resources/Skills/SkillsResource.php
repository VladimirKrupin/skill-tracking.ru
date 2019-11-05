<?php

namespace App\Http\Resources\Skills;

use App\Http\Models\Skill\Skill;
use App\Http\Models\User\User;
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
        return [
            'skills' => Skill::where('user_id',Auth::user()['id'])->with('points')->get()->toArray(),
        ];
    }
}
