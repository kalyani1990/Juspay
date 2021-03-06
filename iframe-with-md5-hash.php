<?php

# This example shows to use the iFrame based solution without the call to /order/create API.

# Replace the below with your credentials.

$api_key = '782CB4B3F5B84BDDB3C9EAFA6A134DC3';
$merchant_id = 'guest';
$order_id = rand();
$amount = '10.00';
$customer_id = 'customerId';
$customer_email = 'customer@mail.com';

# Compute the signature that need to be sent to our servers.
# Signature to be hashed should be of format api_key|merchant_id|order_id|amount|customer_id|customer_email
$hash = md5("$api_key|$merchant_id|$order_id|$amount|$customer_id|$customer_email");


echo "<center><b>Juspay Integration Example</b></center>";

echo "<br /><br />";

# Now embed the iFrame with the computed hash and also other required details.
echo " <center> 
          <iframe src=\"https://api.juspay.in/merchant/ipay?merchant_id=$merchant_id&order_id=$order_id&amount=$amount&customer_id=$customer_id&customer_email=$customer_email&signature=$hash\"
           width=\"630\" height=\"400\" style=\"border: 1px solid #CCC;padding: 20px;height: auto;min-height: 300px;\">
          </iframe>
       </center>
      ";
?>