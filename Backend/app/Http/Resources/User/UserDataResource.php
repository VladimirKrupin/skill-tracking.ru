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
        $data['lang'] = '';
        $data['name'] = '';
        $data['surname'] = '';
        $data['gender'] = 'Not specified';
        $data['age'] = '';
        $data['country'] = '';
        $data['city'] = '';
        $data['work'] = '';
        $data['position'] = '';
        $data['about'] = '';
        if (!is_null($this['settings'])) {
            foreach ($this['settings'] as $setting) {
                $data[$setting['key']] = $setting['value'];
            }
        }
        $userData = [
            'email' => $this['email'],
            'lang' => $data['lang'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'country' => $data['country'],
            'city' => $data['city'],
            'work' => $data['work'],
            'position' => $data['position'],
            'about' => $data['about'],
        ];
        return [
            'data' => $userData,
        ];
    }
}
