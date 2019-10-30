<?php
namespace App\Http\Controllers\Skills;

use App\Http\Controllers\Controller;
use App\Http\Response\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{
    public function saveSkill(Request $request){
//        var_dump($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:255',
            'icon' => 'required|string|min:1|max:255',
            'color' => 'required|string|min:1|max:255',
            'points.*.name' => 'required|string|min:1|max:255',
            'points.*.units' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {return ValidatorResponse::get($validator->errors());}

    }
}