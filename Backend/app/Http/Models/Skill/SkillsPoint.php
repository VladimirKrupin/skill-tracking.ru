<?php

namespace App\Http\Models\Skill;

use Illuminate\Database\Eloquent\Model;

class SkillsPoint extends Model
{
    protected $fillable = [
        'skill_id', 'title', 'units','units_type'
    ];
    public function skill(){
        return $this->belongsTo('App\Http\Models\Skill\Skill');
    }
}
