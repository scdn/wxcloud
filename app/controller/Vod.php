<?php
namespace app\controller;
use app\model\Fixed;

class Vod{
    public function start($deviceId,$channelId){
        $host=Fixed::HOST;
        $query="/api/play/start/".$deviceId.'/'.$channelId;
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $output = curl_exec($ch);
        curl_close($ch);
        $hls=json_decode($output)->data->hls;
        //此处hls用于微信小程序
        return json_encode([
            'url'=>$hls
        ],255);
        $this->assign('playURL',$hls);
        return $this->fetch();
    }
    public function stop($deviceId,$channelId){
        $host=Fixed::HOST;
        $query="/api/play/stop/".$deviceId.'/'.$channelId;
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $output = curl_exec($ch);
        curl_close($ch); 
        return $output;
    }
    public function status($deviceId){
        $host=Fixed::HOST;
        $query="/api/device/query/devices/".$deviceId."/status";
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    public function getAllSsrc(){
        $host=Fixed::HOST;
        $query="/api/play/ssrc";
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}