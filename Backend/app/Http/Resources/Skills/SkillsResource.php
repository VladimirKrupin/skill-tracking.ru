<?php

namespace App\Http\Resources\Skills;

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
        $skills = User::where('id',$this['id'])->first()->toArray();
        $skills = [
            [
              'title'=>'reading',
              'description'=>'my reading books',
              'bg'=>'bg-success',
              'icon'=>'icon-book-open',
              'type' => 1
            ],
            [
                'title'=>'sport',
                'description'=>'sport exercises',
                'bg'=>'bg-info',
                'icon'=>'icon-fire',
                'type' => 2
            ],
            [
                'title'=>'programmind',
                'description'=>'sport exercises',
                'bg'=>'bg-info',
                'icon'=>'icon-fire',
                'type' => 3
            ],
            [
                'title'=>'music',
                'description'=>'sport exercises',
                'bg'=>'bg-info',
                'icon'=>'icon-fire',
                'type' => 4
            ],
        ];
        return [
            'skills' => $skills,
        ];
    }
}
