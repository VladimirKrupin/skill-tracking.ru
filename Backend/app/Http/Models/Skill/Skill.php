<?php

namespace App\Http\Models\Skill;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'color', 'icon', 'type','active'
    ];
    public function points(){
        return $this->hasMany('App\Http\Models\Skill\SkillsPoint');
    }
}
