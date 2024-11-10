<?php

$curl = curl_init();
//this one is to initiate a transaction


$payout_amount = 100; //will be inputted by the user
$transaction_pin = 1111;
$account_reference = "1010000009";
$currency = "NGN"; //constant since it's for Nigeria
$country = "NGA"; //constant since it's for Nigeria
$account_number = "9207067319"; //will be gotten from an input field or from the db if the beneficiary's details have been stored before by the user
$account_name = "Timothy Oluwasegun"; //account name of the beneficiary
$bank_code = "000013"; //bank code of the beneficiary's bank
$narration = "Test"; //this is the description of the transaction and will be inputted by the user 
$transaction_reference = "TD93001234";
$sender_name = "Alice Jakani";
$sender_phone_number = "01234595";
$sender_address = "123, Ace Street";

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.payaza.africa/live/payout-receptor/payout',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
        "transaction_type": "nuban",
        "service_payload": {
            "payout_amount": ' . $payout_amount . ',
            "transaction_pin": ' . $transaction_pin . ',
            "account_reference": "' . $account_reference . '",
            "currency": "' . $currency . '",
            "country": "' . $country . '",
            "payout_beneficiaries": [
                {
                    "credit_amount": ' . $payout_amount . ',
                    "account_number": "' . $account_number . '",
                    "account_name": "' . $account_name . '",
                    "bank_code": "' . $bank_code . '",
                    "narration": "' . $narration . '",
                    "transaction_reference": "' . $transaction_reference . '",
                    "sender": {
                        "sender_name": "' . $sender_name . '",
                        "sender_id": "",
                        "sender_phone_number": "' . $sender_phone_number . '",
                        "sender_address": "' . $sender_address . '"
                    }
                }
            ]
        }
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Payaza UFo3OC1QS1RFU1QtQTE2Qzg4N0QtMDFCQy00QjVGLThDMTMtODQ5NDJFREU4MDA1', //UFo3OC1QS1RFU1QtNDZBRkFGNTItQTdGRi00M0E2LUIzNTMtOTMxMzYwOUZEQTA2
        'X-tenantID: test',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

//here, the string response is changed to json format
$responseJson = json_decode($response, true);

//check if the transaction was successfull and all other things related to the transaction
$responseCode = $responseJson["response_code"];
if ($responseCode !== 200){
  echo '<BR>';
  echo("An error occured while processing the transaction. Error code is: " . $responseCode);
  echo '<BR>';
}elseif ($responseCode === 200){
  $transactionRequestTime = $responseJson["transaction_time"];
  $transactionRequestAmount = $responseJson["amount"];

  echo '<BR>';
  echo "Transaction successfully initiated!";
  echo '<BR>';
  echo("Time of transaction request: " . $transactionRequestTime);
  echo("Transaction request amount: " . $transactionRequestAmount);
  //the transactionRequestTime and transactionRequestAmount should vbe stored in the db 
  //so that users can refer to them later

}

curl_close($curl);
echo $response; // this is gonna be removed. I left it for debugging purposes

?>