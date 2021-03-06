<?php

# Example integration with iFrame based solution

# Step 1

# Create the order with /order/create API call
$ch = curl_init('https://api.juspay.in/order/create');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    

# You should use your API key here. This API is a test Key wont work in production.                 
curl_setopt($ch, CURLOPT_USERPWD, '7AF0A0ECEE5940FAA6345F0BAC67315D:');
curl_setopt($ch, CURLOPT_POST, 1); 


# Set the customer_id, customer_email , amount and order_id as per details.
# NOTE: The amount and order_id are the fields associated with the "current" order.
$customer_id = 'guest_user_101';
$customer_email = 'customer@mail.com';
$amount = '10.00';
$order_id = rand();
# This is the URL where the customer will be redirected to. Change localhost to your domain.
$return_url = "http://localhost/payment_status.php";

curl_setopt($ch, CURLOPT_POSTFIELDS, array('customer_id' => $customer_id , 'customer_email' => $customer_email , 
                         'amount' => $amount , 'order_id' => $order_id , 'return_url' => $return_url ));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);                    
curl_setopt($ch,CURLOPT_TIMEOUT, 15); 

$response = curl_exec($ch);
$responseBody = json_decode ($response, true );
echo "<center><b>Juspay Integration Example</b></center>";
$iframe_pay=$responseBody['payment_links']['iframe'];
echo "<br /><br />";


# Step 2
# After initiating the order use Juspay's iFrame solution.

echo "<center><iframe src=\"$iframe_pay\" width=\"420\" height=\"320\" 
        style=\"border: 2px solid #CCC;padding: 45px;height: auto;min-height: 250px;\">
        </iframe>
    </center>"   
    
?>