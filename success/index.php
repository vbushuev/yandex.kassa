<?php
//ob_start();
chdir("..");
include "autoload.php";
use core\Log as Log;
$rq = $_REQUEST;
$successUrl = isset($rq["cb_response_url"])?$rq["cb_response_url"]:'http://checkauto.cars-bazar.ru';
if(isset($rq["vin"])&&!empty($rq["vin"])&&isset($rq["email"])&&!empty($rq["email"])){
    header('Location: '.$successUrl.'/reports.php?payed=1&cb_order_id='.$rq["cb_order_id"].'&type=full&email='.$rq["email"].'&vin='.$rq["vin"]);
}else {
    $cb = new cb\ClientBase();
    $current = $cb->get(["ID"=>$rq["cb_order_id"]]);
    foreach($current as $row){
        $v = $row["line"];
    	header('Location: '.$successUrl.'/reports.php?payed=1&cb_order_id='.$rq["cb_order_id"].'&type=full&email='.$v["email"].'&vin='.$v["vin"]);
        break;
    }

}
//print_r($rq);
?>
