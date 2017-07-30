<?php
$postdata = http_build_query(
    array(
        "cb_order_id"=>"2",
        "shopId"=>"113312",
        "invoiceId"=>"1122334455"
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('http://yakassa.bs2/aviso', false, $context);
echo $result;
?>
