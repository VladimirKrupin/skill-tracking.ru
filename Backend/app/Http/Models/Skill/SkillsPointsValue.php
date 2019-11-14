<?php

namespace App\Http\Models\Skill;

use Illuminate\Database\Eloquent\Model;

class SkillsPointsValue extends Model
{
    protected $fillable = [
        'skills_point_id', 'date', 'value'
    ];
    public function skillPoint(){
        return $this->belongsTo('App\Http\Models\Skill\SkillsPoint');
    }
}
