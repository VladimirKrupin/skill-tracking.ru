<?php

namespace App\Http\Resources\Skills;

use App\Http\Helpers\AppHelper;
use App\Http\Models\Skill\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class SkillPointsValuesByDateResource extends Resource
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
            'points' => $this->points,
        ];
    }
}
