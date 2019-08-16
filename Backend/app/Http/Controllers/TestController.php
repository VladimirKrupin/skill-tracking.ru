<?php
namespace App\Http\Controllers;

class TestController extends Controller{
    public function index(){
        print 'test route';
    }
    public function web(){
        print 'web route';
    }
}