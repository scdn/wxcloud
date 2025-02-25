<?php
namespace app\controller;
use think\facade\Request;
use think\facade\Db;

class Record{
  public function index(){

    $nick=Request::param('nick');
    $openid=Request::param('openid');
    $dir="static/upload/";
    if(isset($_FILES["file"])){
    $file=$dir.basename($_FILES["file"]["name"]);
    if(file_exists($file)){
      return "请勿重复保存";
    }
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$file)){
      $data=[
        'nick'=>$nick,
        'openid'=>$openid,
        'uri'=>$file
      ];
      if(Db::table('recorder')->insert($data)){
        return "保存成功";
      }
      
      
    }
    else{
      echo "ERROR";
    }
    }else{
      echo "此为微信小程序上传接口,无法直接打开,请通过微信小程序'小文录音机'进行使用";
    }
  }
  public function read(){
    $openid=Request::param('openid');
    //$result=Db::table('recorder')->where('openid',$openid)->order('id','desc')->limit(10)->select();
    //select *from ( select * from table1 order by datetime desc limit 0,10 ) order by datetime
    $result=Db::query("select * from (select * from wechat where openid='{$openid}' order by id desc limit 0,5) as a order by id");
           return json_encode($result,JSON_UNESCAPED_UNICODE);
  }
  public function login(){
    $code=Request::param('code');
    $appid="wx953047dd358bc805";
    $secret="9c6c01c8a7a99fed09fad469fccbf29d";
    $url="https://api.weixin.qq.com/sns/jscode2session?";
    $query=http_build_query([
      'appid'=>$appid,
      'secret'=>$secret,
      'js_code'=>$code,
      'grant_type'=>'authorization_code'
    ]);
    $request_url=$url.$query;
    $opts=[
      'http'=>[
        'method'=>'GET',
        'header'=>[
          'Content-Type:application/json',
          'Charset:utf8'
        ]
      ]
    ];
    $context=stream_context_create($opts);
    $data=file_get_contents($request_url,false,$context);
    return $data;
  }
}

 ?>
