<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.payaza.africa/live/merchant-collection/transfer_notification_controller/merchant/transaction-query?merchant_reference=" . $_GET['ref'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Payaza UFo3OC1QS1RFU1QtQTE2Qzg4N0QtMDFCQy00QjVGLThDMTMtODQ5NDJFREU4MDA1'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
