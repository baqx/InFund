<?php

$url = "https://openrouter.ai/api/v1/chat/completions";
$keyIndex = 0;
$OPENROUTER_API_KEY_1 = "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";
$OPENROUTER_API_KEY_2 = "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";
$OPENROUTER_API_KEY = $OPENROUTER_API_KEY_2;
$isWorking = false;

$spamCount = 0;
$genuineCount = 0;
$unsureCount = 0;

//sample prompt
$promptCampaign = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien est, interdum sed aliquam non, tempus sit amet elit. Aenean non tristique felis. Aliquam efficitur euismod arcu, eget finibus turpis aliquam at. In hac habitasse platea dictumst. Integer semper hendrerit diam, quis dictum erat scelerisque eget. Morbi malesuada sapien at urna dictum, ut varius ligula porta. Proin sodales, leo nec pellentesque finibus, ex tortor hendrerit sem, sit amet pulvinar nibh nunc quis nunc. Curabitur lectus orci, feugiat at ipsum ut, interdum feugiat leo. Quisque et semper augue, eget ullamcorper nisl. Quisque magna diam, congue ac enim et, finibus elementum diam. Phasellus nibh nunc, interdum ut dignissim eget, aliquet sit amet nisl. Sed tincidunt faucibus erat, feugiat sollicitudin lectus tincidunt in. Vivamus ac elit sit amet ante fringilla blandit. Vivamus pretium, massa tincidunt volutpat rhoncus, nunc lectus faucibus sem, eget congue justo neque eu enim. Aenean rutrum egestas suscipit. Duis id congue sapien.";
$editedPromptCampaign = "PROMPT : " . $promptCampaign; 

$criteria = "A campaign is a means for crowdfunding for ONLY university educational purposes. 

Evaluate using these key indicators:

Likely_Genuine Indicators:
- Clear, detailed description of educational purpose(classify as likely_spam if vague, unclear or missing)
- Said purpose must actually be educational in nature
- Specific breakdown of how funds will be used for said educational purpose(classify as likely_spam if vague, unclear or missing)

Likely_Spam Indicators:
- Has no clear educational purpose
- Vague or generic educational purpose
- Overly emotional or manipulative language
- Lack of specific fund allocation details(this is of extreme importance)
- Threatening message or tone

Likely_Unsure Indicators:
- Partially incomplete information
- Some details present but lacking full clarity
- Moderate inconsistencies in the description
- Requires additional verification


If your classification is 'likely_genuine' then let your only response strictly be likely_genuine.
If your classification is 'likely_spam' then let your only response strictly be likely_spam.
If your classification is 'likely_unsure' then let your only response strictly be likely_unsure.";

// API PROCESSING STARTS   
$headers = [
    "Authorization: Bearer " . $OPENROUTER_API_KEY,
    "Content-Type: application/json"
];

$data = [
    "model" => "nousresearch/hermes-3-llama-3.1-405b:free",
    "messages" => [
        [
            "role" => "user",
            "content" => $editedPromptCampaign . $criteria
        ]
    ]
];

$standardData = [
    "model" => "nousresearch/hermes-3-llama-3.1-405b:free",
    "messages" => [
        [
            "role" => "user",
            "content" => "Hello"
        ]
    ]
];

function makePostRequest($url, $data, $headers = []) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }
    curl_close($ch);

    return json_decode($response, true);
}

function switchApiKey(&$currentKeyIndex) {
    $currentKeyIndex = ($currentKeyIndex + 1) % 2;
    if ($currentKeyIndex == 0) {
        $GLOBALS['OPENROUTER_API_KEY'] = $GLOBALS['OPENROUTER_API_KEY_1'];   
    }else{
        $GLOBALS['OPENROUTER_API_KEY'] = $GLOBALS['OPENROUTER_API_KEY_2'];
    }
}

//For deciding to switch another key or not
for($retries = 0; $retries < 4; $retries++){
    $standardResponseData = makePostRequest($url, $standardData, $headers);
    if (isset($standardResponseData['choices'])){
        $isWorking = true;
        break;
    }
    switchApiKey($keyIndex);

}



if (isset($standardResponseData['choices']) && $isWorking = true){
    for ($i = 0; $i < 5; $i++){
        $responseData = makePostRequest($url, $data, $headers);
        try{
            $assistantResponse = $responseData['choices'][0]['message']['content'];
        }
        catch (Throwable $e){
            echo "Something went wrong somehere";
            break;
        }   
        switch ($assistantResponse){
            case 'likely_spam':
                $spamCount++;
                break;
            case 'likely_genuine':
                $genuineCount++;
                break;
            case 'likely_unsure':
                $unsureCount++;
                break;
            default:
                break;
        }
        sleep(2);
    }
    
    $totalCount = $genuineCount + $spamCount + $unsureCount;
    if ($totalCount != 0){
        echo "Total Count : $totalCount \n \n";
    
        $percentSpam = ($spamCount / $totalCount) * 100;
        $percentGenuine = ($genuineCount / $totalCount) * 100;
        $percentUnsure = ($unsureCount / $totalCount) * 100;
    
        $percentages = array('spam' => $percentSpam, 
                            'genuine' => $percentGenuine, 
                            'unsure' => $percentUnsure
                        );
    
        $maxPercentage = max($percentSpam, $percentGenuine, $percentUnsure);
        $decision = array_search($maxPercentage, $percentages);
    
        echo '<BR>';
        echo '<BR>';
        echo '<BR>';
    
        echo "Decision : $decision";
        echo '<BR>';
        print_r($percentages);
        echo '<BR>';
        echo $GLOBALS['keyIndex'];
    }else{
        echo "Problem during decision--no count";
    }
}else{
    echo "Service Temporarily Unavailable. Please try again later";
}

?>