<?php
namespace App\Http\Workers\Skills\SkillPoints;

use App\Http\Models\Skill\SkillsPoint;
use App\Http\Models\Skill\SkillsPointsValue;
use Carbon\Carbon;

abstract class SkillPointAbstract implements SkillPointInterface
{
    protected $point = null;
    protected $values = null;
    protected $values_dates;
    public function __construct(SkillsPoint $skillPoint)
    {
        $this->point = $skillPoint;
    }
    public function updateOrCreate()
    {

    }
    public function setValue($date = null){
        $date = (is_null($date))?Carbon::now()->format('Y-m-d'):$date;
        $value = SkillsPointsValue::where('skills_point_id',$this->point->id)->where('date',$date)->first();
        if ($value){
            $this->values[$value->date] = $value;
            $this->values_dates[] = $value->date;
        }
    }
}