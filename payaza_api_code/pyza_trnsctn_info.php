<?php

$curl = curl_init();
//this one is to get information about a particular transaction 

$transactionReference = "P-C-20241109-CAXU53E4IL"; //this will be changed to an actual transaction reference from the db

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.payaza.africa/live/payaza-account/api/v1/mainaccounts/merchant/transaction/' . $transactionReference,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-TenantID: test',
    'Authorization: Payaza UFo3OC1QS1RFU1QtQTE2Qzg4N0QtMDFCQy00QjVGLThDMTMtODQ5NDJFREU4MDA1'
  ),
));

$response = curl_exec($curl);
$responseJson = json_decode($response, true);

if (isset($responseJson["data"]) && $responseJson["data"] != null){
  $transactionDateTime =  $responseJson["data"]["transactionDateTime"];
  $transactionReference =  $responseJson["data"]["transactionReference"];
  $creditAccount =  $responseJson["data"]["creditAccount"];
  $beneficiaryName =  $responseJson["data"]["beneficiaryName"];
  $transactionAmount =  $responseJson["data"]["transactionAmount"];
  $transactionStatus =  $responseJson["data"]["transactionStatus"];
  $narration =  $responseJson["data"]["narration"];
  $transactionType =  $responseJson["data"]["transactionType"];
  $currency =  $responseJson["data"]["currency"];
  $balanceBefore =  $responseJson["data"]["balanceBefore"];
  $balanceAfter =  $responseJson["data"]["balanceAfter"];
  $transactionDateTime =  $responseJson["data"]["transactionDateTime"];
  $transactionDateTime =  $responseJson["data"]["transactionDateTime"];

  switch($transactionStatus){
    case "TRANSACTION_INITIATED":
      echo "The transaction has being queued for processing";
      echo '<BR>';
      break;
    case "NIP_SUCCESS":
      echo "The transaction was successfull";
      echo '<BR>';
      break;
    case "NIP_PENDING":
      echo "The transaction is still in progress";
      echo '<BR>';
      break;
    case "NIP_FAILURE":
      echo "The transaction failed"; 
      echo '<BR>';
      break;
    case "ESCROW_SUCCESS":
      echo "The amount has been deducted, but it is being processed by the bank, and it can be reversed due to network problems";     
      echo '<BR>';
      break;
    }
}else{
    echo "An error occurred";
}

curl_close($curl);
echo $response; // this is gonna be removed. I left it for debugging purposes

?>
      