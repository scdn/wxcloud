<?php
namespace app\model;
class Fixed{
    //CONST HOST="http://82.157.183.217:18080";
    CONST HOST="http://8.140.51.7:8080";
    CONST ZLM="http://8.140.51.7:6080";
    CONST username='admin';
    CONST password='admin';
    static public function token(){
        $uri="/api/user/login?";
        $data=http_build_query([
            'username'=>self::username,
            'password'=>md5(self::password)
        ]);
        $url=self::HOST.$uri.$data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded"));
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output)->data->accessToken  ;
    }
}