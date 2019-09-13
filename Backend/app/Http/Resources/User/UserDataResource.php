<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class UserDataResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = '';
        $name = '';
        $surname = '';
        $age = '';
        $address = '';
        $work = '';
        $position = '';
        $about = '';
        if (!is_null($this['settings'])) {
            foreach ($this['settings'] as $setting) {
                if ($setting['key'] === 'lang') {
                    $lang = $setting['value'];
                }
            }
        }
        $userData = [
            'email' => $this['email'],
            'lang' => $lang,
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
            'address' => $address,
            'work' => $work,
            'position' => $position,
            'about' => $about,
        ];
        return [
            'data' => $userData,
        ];
    }
}
