<?php
ob_start();
include "autoload.php";
use core\Log as Log;

$rq = $_REQUEST;
$method = $rq["_p"];
$cb = new cb\ClientBase();

print("Method: ". $method.":\n");
print_r($rq);
$rs = "";
$header = 'Content-Type: application/xml; charset=utf-8';
if($method == "check" || $method == "/test/check"){
	$rs = '<checkOrderResponse performedDatetime="'.date("Y-m-d\TH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
}
else if($method == "aviso" || $method == "/test/aviso"){
	$upd = [
		"ID"=>$rq["cb_order_id"],
		"payed"=>"1",
		"status"=>"full",
		"promo"=>"",
		"email"=>$rq["email"],
		"amount"=>$rq["orderSumAmount"]
	];
	if(isset($rq["phone"]))$upd["phone"]=$rq["phone"];
	if(isset($rq["vin"]))$upd["vin"]=$rq["vin"];
	if(isset($rq["promo"])){
		$promo = new cb\Promo();
		$promo->used($rq["promo"]);
		$upd["promo"] = $rq["promo"];
	}
	$current = $cb->update($upd);
	$rs = '<paymentAvisoResponse performedDatetime="'.date("Y-m-d\TH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
}
else if($method == "success"){
	$current = $cb->get(["ID"=>$rq["cb_order_id"]]);
	$successUrl = isset($rq["cb_response_url"])?$rq["cb_response_url"]:'http://checkauto.cars-bazar.ru';
	foreach($current as $row){
        $v = $row["line"];
		$header = 'Location: '.$successUrl.'/reports.php?payed=1&type=full&vin='.$v["vin"];
        break;
    }
}
Log::debug(ob_get_clean());
header($header);
echo $rs;
?>
