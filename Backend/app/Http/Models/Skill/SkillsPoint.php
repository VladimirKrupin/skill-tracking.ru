<?php

namespace App\Http\Models\Skill;

use Illuminate\Database\Eloquent\Model;

class SkillsPoint extends Model
{
    protected $fillable = [
        'skill_id', 'title', 'units','units_type','active'
    ];
    public function skill(){
        return $this->belongsTo('App\Http\Models\Skill\Skill');
    }
    public function values(){
        return $this->hasMany('App\Http\Models\Skill\SkillsPointsValue');
    }
    public function value(){
        return $this->hasOne('App\Http\Models\Skill\SkillsPointsValue');
    }
}
