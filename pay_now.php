<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

require('payhere_config/config_payhere.php');


date_default_timezone_set("Asia/Colombo");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['pay_now'])) {
    $ORDER_ID = 'ORD_' . $_SESSION['uID'] . random_int(11111, 9999999);
    $MERCHANT_ID = PAYHERE_MERCHANT_ID;
    $CURRENCY = PAYHERE_CURRENCY;
    $AMOUNT = $_SESSION['room']['payment'];

    $frm_data = filteration($_POST);

    // Insert booking order
    $query = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
              VALUES (?,?,?,?,?)";

    insert($query, [$_SESSION['uID'], $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID], 'iisss');
    $booking_id = mysqli_insert_id($con);

    // Insert booking details
    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) 
               VALUES (?,?,?,?,?,?,?)";

    insert($query2, [
        $booking_id,
        $_SESSION['room']['name'],
        $_SESSION['room']['price'],
        $AMOUNT,
        $frm_data['name'],
        $frm_data['phonenum'],
        $frm_data['address']
    ], 'issssss');

    // Create hash
    $hash = strtoupper(
      md5(
          $MERCHANT_ID .
          $ORDER_ID .
          number_format($AMOUNT, 2, '.', '') .
          $CURRENCY .
          strtoupper(md5(PAYHERE_MERCHANT_SECRET))
      )
    );
  
    // Prepare form data for PayHere
    $paramList = [
        "merchant_id" => $MERCHANT_ID,
        "return_url" => PAYHERE_RETURN_URL,
        "cancel_url" => PAYHERE_CANCEL_URL,
        "notify_url" => PAYHERE_NOTIFY_URL,
        "order_id" => $ORDER_ID,
        "items" => $_SESSION['room']['name'],
        "amount" => $AMOUNT,
        "currency" => $CURRENCY,
        "first_name" => $frm_data['name'],
        "last_name" => '',
        "email" => 'r@gmail.com',
        "phone" => $frm_data['phonenum'],
        "address" => $frm_data['address'],
        "city" => "Colombo",
        "country" => "Sri Lanka",
        "hash" => $hash,
    ];
    $jsonObj = json_encode($paramList);
    echo $jsonObj;
    
}

?>

<!-- <html>
<head>
    <title>Redirecting to PayHere...</title>
</head>
<body>
    <h1>Please do not refresh this page...</h1>
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout" name="payhere_form">
        <?php
        foreach ($paramList as $name => $value) {
            echo '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '">';
        }
        ?>
        <input type="hidden" name="hash" value="<?php echo $hash; ?>">
    </form>
    <script type="text/javascript">
        document.payhere_form.submit();
    </script>
</body>
</html> -->

<!DOCTYPE html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="payhere_config/script.js"></script>
</head>

<body>
    <div class="body">
        <div>
            <button onclick="paymentGateway();">Pay Here</button>
        </div>
    </div>
    
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>

