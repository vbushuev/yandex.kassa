<?php
ob_start();
include "autoload.php";
$rq = $_POST;
$cb = new cb\ClientBase();
$current = $cb->get(["ID"=>$rq["cb_order_id"]]);
$rs = [
	"performedDatetime"=>date("Y-m-d"),
	"code"=>"0",
	"shopId"=>$rq["shopId"],
	"invoiceId"=>$rq["invoiceId"],
	"orderSumAmount"=>$rq["orderSumAmount"],
	"message"=>"Ok"
];
ob_end_clean();
header('Content-Type: application/xml; charset=utf-8');
echo '<paymentAvisoResponse performedDatetime="'.date("Y-m-dTH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
?>
