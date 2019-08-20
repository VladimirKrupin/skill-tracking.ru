<?php
namespace App\Http\Controllers;
use App\Http\Models\User\User;
use App\Http\Resources\TestResource;

class TestController extends Controller{
    public function index(){
        TestResource::withoutWrapping();
        $user = User::where('id',1)->first();
        return new TestResource($user);
    }
    public function web(){
        print 'web route';
    }
}