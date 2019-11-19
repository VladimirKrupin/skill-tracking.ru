<?php
namespace App\Http\Workers\Skills\Skill;

use App\Http\Models\Skill\Skill as SkillModel;
use App\Http\Models\Skill\SkillsPoint;
use App\Http\Workers\Skills\SkillException;
use App\Http\Workers\Skills\SkillPoints\SkillPointAbstract;
use App\Http\Workers\Skills\SkillPoints\SkillPointAbstractFactory;

class Skill
{
    /**
     * @var SkillModel | null
     */
    public $skill = null;
    /**
     * @var array | null
     */
    public $active_points = null;

    /**
     * @var array |  null
     */
    public $active_points_ids = null;

    /**
     * @param $id integer
     * @return SkillPointAbstract | null
     */
    public function point($id){
        return $this->active_points[$id];
    }
    public function __construct($user_id,$skill_id)
    {
        $skill = SkillModel::where('user_id',$user_id)->where('id',$skill_id)->first();
        if ($skill){
            $this->skill = $skill;
        }else {
            throw new SkillException('Not found');
        }
    }
    public function setActivePoints(){
        $active_points = SkillsPoint::where('skill_id',$this->skill->id)->where('active',1)->get();
        if (!empty($active_points)){
            foreach ($active_points as $skill_point) {
                $this->active_points[$skill_point['id']] = SkillPointAbstractFactory::getSkillPoint($skill_point);
                $this->active_points_ids[] = $skill_point['id'];
            }
        }else {
            throw new SkillException('Not found active points');
        }
    }
    public function setPointsValues($date){
        foreach ($this->active_points_ids as $id){
            $this->point($id)->setValue($date);
        }
    }
    public function updatePointsValues(){

    }
}