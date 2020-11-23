<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

# 初期設定
$KEYID = "5a6c86f3637d03b51eb3ff5df77d75d5";
$HIT_PER_PAGE = 100;
$PREF = "PREF13";
$FREEWORD_CONDITION = 1;
$FREEWORD = "渋谷駅";
$LANG = "ja";

$PARAMS = array("keyid"=> $KEYID, "hit_per_page"=>$HIT_PER_PAGE, "pref"=>$PREF, "freeword_condition"=>$FREEWORD_CONDITION, "freeword"=>$FREEWORD);

function write_data_to_csv($params){
    
    $restaurants = [];
    $client = new Client();
    try{
       $json_res = $client->request('GET', "https://api.gnavi.co.jp/RestSearchAPI/v3/", ['query' => $params])->getBody();
    }catch(Exception $e){
        var_dump(json_decode($e->getResponse()->getBody()->getContents()));
        return print("エラーが発生しました。");
    }
    $response = json_decode($json_res,ture);
    
    if(isset($response["error"])){
        return(print("エラーが発生しました！"));
    }
    foreach($response["rest"] as $restaurant){
        $restaurant_name = $restaurant["name"];
        $restaurants[] = $restaurant_name;
    }
    $handle = fopen("restaurants_list.csv", "wb");
    fputcsv($handle, $restaurants);
    fclose($handle);
    return print_r($restaurants); 
}

write_data_to_csv($PARAMS);

?>