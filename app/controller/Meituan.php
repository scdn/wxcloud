<?php
namespace app\controller;
use think\facade\View;

class Meituan{
    function app(){
        return View::fetch();
    }
}