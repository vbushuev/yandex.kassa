<?php
ob_start();
include "autoload.php";
$method = $_GET["_p"];

$rq = $_POST;
$cb = new cb\ClientBase();

$rs = "";
if($method == "check" || $method == "/test/check"){
	$rs = '<checkOrderResponse performedDatetime="'.date("Y-m-dTH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
}
else if($method == "aviso" || $method == "/test/aviso"){
	$rs = [
		"performedDatetime"=>date("Y-m-d"),
		"code"=>"0",
		"shopId"=>$rq["shopId"],
		"invoiceId"=>$rq["invoiceId"],
		"orderSumAmount"=>$rq["orderSumAmount"],
		"message"=>"Ok"
	];
	$current = $cb->update(["ID"=>$rq["cb_order_id"],"payed"=>"1"]);
	$rs = '<paymentAvisoResponse performedDatetime="'.date("Y-m-dTH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
}
ob_end_clean();
header('Content-Type: application/xml; charset=utf-8');
echo $rs;
?>
