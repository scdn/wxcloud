<?php
namespace app\controller;
use app\model\Fixed;

class Device{
    public function query($deviceId){
        $host=Fixed::HOST;
        $query="/api/device/query/devices/".$deviceId;
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
    public function queryTree($deviceId,$page="1",$count="10"){
        $host=Fixed::HOST;
        $querydata=http_build_query([
            'page'=>$page,
            'count'=>$count
        ]);
        $query="/api/device/query/tree/".$deviceId.'?'.$querydata;
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
    public function subscribeInfo($deviceId){
        $host=Fixed::HOST;
        $query="/api/device/query/".$deviceId."/subscribe_info";
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
    public function channelTree($deviceId,$page='1',$count='32'){
        $host=Fixed::HOST;
        $querydata=http_build_query([
            'page'=>$page,
            'count'=>$count
        ]);
        $query="/api/device/query/tree/channel/".$deviceId.'?'.$querydata;;
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
    public function snap($deviceId,$channelId){
        $host=Fixed::HOST;
        $query="/api/device/query/snap/".$deviceId."/".$channelId;
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $picStream = curl_exec($ch);
        curl_close($ch);
        $file='test3.jpg';
        file_put_contents($file,$picStream);   
    }
    public function queryDevices($page="1",$count="20"){
        /**
         * 默认读取一页20条，设备数量多时，需再优化
         */
        $host=Fixed::HOST;
        $querydata=http_build_query([
            'page'=>$page,
            'count'=>$count
        ]);
        $query="/api/device/query/devices?".$querydata;
        $url=$host.$query;
        $token=Fixed::token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded",'access-token:'.$token));
        $output = curl_exec($ch); 
        curl_close($ch);
        $deviceTotal=json_decode($output)->data->total;
        $deviceListInfo=json_decode($output)->data->list;
        
        //先获取一个设备，进行测试 
        //dump($deviceListInfo);
        //i=2， 先测试一个设备
        for($i=2;$i<$deviceTotal;$i++){
            $deviceId=$deviceListInfo[$i]->deviceId;
            $deviceName=$deviceListInfo[$i]->name;
            $status=($deviceListInfo[$i]->onLine?"online":"offline");
        echo json_encode([
            'deviceId'=>$deviceId,
            'deviceName'=>$deviceName,
            'status'=>$status
        ]);
        }

    }
 
}