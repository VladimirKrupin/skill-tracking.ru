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
        $gender = 'Not specified';
        $age = '';
        $country = '';
        $city = '';
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
            'gender' => $gender,
            'age' => $age,
            'country' => $country,
            'city' => $city,
            'work' => $work,
            'position' => $position,
            'about' => $about,
        ];
        return [
            'data' => $userData,
        ];
    }
}
