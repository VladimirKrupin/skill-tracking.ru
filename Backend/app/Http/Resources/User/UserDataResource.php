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
        foreach ($this->settings as $setting){
            if ($setting->key === 'lang'){
                $lang = $setting->value;
            }
        }
        return [
            'lang' => $lang,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
