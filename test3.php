
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="https://checkout-v2.payaza.africa/js/v1/bundle.js"></script>

    <script defer>

        function handleButtonClick() {
            const payazaCheckout = PayazaCheckout.setup({ 
                merchant_key:  "PZ78-PKTEST-A16C887D-01BC-4B5F-8C13-84942EDE8005",
                connection_mode: "Test", // Live || Test
                checkout_amount: Number(10),
                currency_code: "NGN",   
                email_address: "johndoe@gmail.com",
                first_name: 'Big',
                last_name: 'Maitre',
                phone_number: "01232425262",
                transaction_reference: "baqx1",
                
                  // Additional Details (metadata)
                additional_details: {
                    user_id: 1273,
                    ticket: "TEUBD9382892"
                }               
            });

            // You can set the onClose and callback function as described below
            function callback(callbackResponse) {
                console.log('callbackResponse: ', callbackResponse)
            }

            function onClose() {
                console.log("closed")
                window.location.href = 'https://google.com'
            }

            payazaCheckout.setCallback(callback)
            payazaCheckout.setOnClose(onClose)

            // Display popup
            payazaCheckout.showPopup();
        }//end function handleButtonClick

    </script>

</head>

<body>
<button onclick="handleButtonClick()">Proceed!!!</button>
</body>


