<?php

# Create the order with /order/create API call
$ch = curl_init('https://api.juspay.in/order/create');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    

# You should use your API key here. This API is a test Key wont work in production.                 
curl_setopt($ch, CURLOPT_USERPWD, '782CB4B3F5B84BDDB3C9EAFA6A134DC3:');
curl_setopt($ch, CURLOPT_POST, 1); 


# Set the customer_id, customer_email , amount and order_id as per details.
# NOTE: The amount and order_id are the fields associated with the "current" order.
$customer_id = 'guest_user_101';
$customer_email = 'customer@mail.com';
$amount = '10.00';
# Create a "unique" order id.
$order_id = rand();


curl_setopt($ch, CURLOPT_POSTFIELDS, array('customer_id' => $customer_id , 'customer_email' => $customer_email , 
                         'amount' => $amount , 'order_id' => $order_id ));
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);                    
curl_setopt($s,CURLOPT_TIMEOUT, 15); 

?>


<html>
<head>
        <!--Twitter Bootstrap resources-->
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.no-icons.min.css" rel="stylesheet">

        <!--Add the pay.js and its depedency Jquery-->
        <script type="text/javascript" 
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
        </script>
        <script type="text/javascript" 
            src="https://api.juspay.in/pay.js"></script>

</head>

  <body>

    <div class="container">    
    <div class="row">
      <div class="form-horizontal offset4 span4">
         <!--A sample dummy form. Make sure you stick to the id and class names as specified-->
          <form class="juspay_express_form" id="payment_form">
              <fieldset>
                  <!--The merchant should pick the "card_token" for particular user-->
                  <input type="hidden" class="card_token" value="11e8e400-5636-4ce4-b4fd-f5b89a34f4f3"/>
                  <input type="hidden" class="merchant_id" value="guest">
                  <?php
                         #Use the same order_id that is generated in previous step.
                         echo "<input type=\"hidden\" class=\"order_id\" value=$order_id />";
                  ?>
                  <legend>Juspay Express Checkout</legend>
                  <div class="control-group">
                    <label class="control-label">Card no</label>
                    <div class="controls">
                      <label>5264-xxxx-xxxx-3394</label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"  for="optionsCheckbox">CVV</label>
                    <div class="controls">
                        <input type="text" class="security_code span1" placeholder="CVV" required = "" />
                    </div>
                  </div>
                  <div class="form-actions">
                    <button type="submit" class="make_payment btn btn-primary">Pay</button>
                    <button class="btn">Cancel</button>
                  </div> 
              </fieldset>
          </form> 
      </div>
    </div>
    </div>


    <!--Call Juspay.setup with your own success and error handler.-->
    <script type="text/javascript">
        Juspay.Setup({
            payment_form: "#payment_form",
            success_handler: function(status) {
                //redirect to success page
                window.location = "success.php";
            },
            error_handler: function(error_code, error_message, bank_error_code, bank_error_message, gateway_id) {
                //redirect to failure page
                window.location = "failure.php";
            }
        })
    </script> 

  </body>
</html>