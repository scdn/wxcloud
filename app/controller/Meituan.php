<?php
namespace app\controller;
use think\facade\View;

class Meituan{
    public function app(){
        return View::fetch();
    }
}