<?php
namespace app\controller;

use Error;
use Exception;
use app\model\Counters;
use think\response\Html;
use think\response\Json;
use think\facade\Log;
use think\facade\View;

class Tool{
    public function cacl24(){
        return View::fetch();
    }
}