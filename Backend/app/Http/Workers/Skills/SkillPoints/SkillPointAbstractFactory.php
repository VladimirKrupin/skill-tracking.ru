<?php
namespace App\Http\Workers\Skills\SkillPoints;

use App\Http\Models\Skill\SkillsPoint;

class SkillPointAbstractFactory
{
    public static function getSkillPoint(SkillsPoint $skillPoint){
        switch ($skillPoint['units_type']){
            case 'time':
                return new SkillPointTime($skillPoint);
                break;
            case 'pages':
                return new SkillPointPage($skillPoint);
                break;
            case 'quantity':
                return new SkillPointQuantity($skillPoint);
                break;
        }
    }
}