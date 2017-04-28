<?php
header('Content-Type: application/xml; charset=utf-8');
ob_start();
include "autoload.php";
$rq = $_POST;
ob_end_clean();
echo '<checkOrderResponse performedDatetime="'.date("Y-m-dTH:i:s.000+03:00").'" code="0" invoiceId="'.$rq["invoiceId"].'" shopId="'.$rq["shopId"].'"/>';
?>
