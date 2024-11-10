<?php

$curl = curl_init();

$currency = "NGN";
$account_number = "9019659410";
$bank_code = "100004";

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://payaza-account-live.payaza.africa/api/v1/mainaccounts/merchant/provider/enquiry',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{
    "service_payload": {
        "currency": "' . $currency . '", 
        "bank_code": "' . $account_number . '",
        "account_number": "' . $bank_code . '"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'X-TenantID: test',
    'Authorization: Payaza UFo3OC1QS1RFU1QtNDZBRkFGNTItQTdGRi00M0E2LUIzNTMtOTMxMzYwOUZEQTA2',
    'Content-Type: application/json',
  ),
));

$response = curl_exec($curl);
$responseJson = json_decode($response, true);

if (isset($responseJson["response_message"]) && $responseJson["response_content"] != null) {
  $accountNumber = $responseJson["response_content"]["account_number"];
  $accountName = $responseJson["response_content"]["account_name"];
  $accountStatus = $responseJson["response_content"]["account_status"];
} else {
  echo "An error occurred";
}

curl_close($curl);
echo $response; // this is gonna be removed. I left it for debugging purposes
