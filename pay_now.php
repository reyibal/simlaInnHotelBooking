<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('payhere_config/config_payhere.php');

date_default_timezone_set("Asia/Colombo");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

// Handle AJAX request to fetch PayHere JSON
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_payment'])) {

    if (!isset($_SESSION['form_data']) || !isset($_SESSION['room'])) {
        http_response_code(400);
        exit('Missing session data');
    }  

    $frm_data = $_SESSION['form_data'];
    $ORDER_ID = 'ORD_' . $_SESSION['uID'] . random_int(11111, 9999999);
    $MERCHANT_ID = PAYHERE_MERCHANT_ID;
    $CURRENCY = PAYHERE_CURRENCY;
    $AMOUNT = $_SESSION['room']['payment'];

    $FORMATTED_AMOUNT = number_format($AMOUNT, 2, '.', '');

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
        $FORMATTED_AMOUNT,
        $frm_data['name'],
        $frm_data['phonenum'],
        $frm_data['address']
    ], 'issssss');

    // Generate hash
    $hash = strtoupper(
        md5(
            $MERCHANT_ID .
            $ORDER_ID .
            $FORMATTED_AMOUNT .
            $CURRENCY .
            strtoupper(md5(PAYHERE_MERCHANT_SECRET))
        )
    );

    // Send JSON
    echo json_encode([
        "merchant_id" => $MERCHANT_ID,
        "return_url" => PAYHERE_RETURN_URL . '?order_id=' . $ORDER_ID,
        "cancel_url" => PAYHERE_CANCEL_URL,
        "notify_url" => PAYHERE_NOTIFY_URL,
        "order_id" => $ORDER_ID,
        "item" => $_SESSION['room']['name'],
        "amount" => $FORMATTED_AMOUNT,
        "currency" => $CURRENCY,
        "first_name" => $frm_data['name'],
        "last_name" => '',
        "email" => 'r@gmail.com',
        "phone" => $frm_data['phonenum'],
        "address" => $frm_data['address'],
        "city" => "Colombo",
        "country" => "Sri Lanka",
        "hash" => $hash
    ]);
    exit;
}

// Handle initial form POST with `pay_now`
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_now'])) {
    $_SESSION['form_data'] = filteration($_POST);
    // Show HTML below
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay Now</title>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</head>
<body>
    <h2>Proceed to Pay</h2>
    <button onclick="paymentGateway();">Pay Here</button>

    <script>
        function paymentGateway() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = () => {
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    try {
                        const obj = JSON.parse(xhttp.responseText);

                        payhere.onCompleted = function(orderId) {
                            console.log("Payment completed. OrderID:" + orderId);
                            window.location.href = "pay_status.php?order_id=" + orderId;
                        };

                        payhere.onDismissed = function() {
                            console.log("Payment dismissed");
                        };

                        payhere.onError = function(error) {
                            console.log("Error:" + error);
                        };

                        const payment = {
                            sandbox: true,
                            merchant_id: obj["merchant_id"],
                            return_url: obj["return_url"],
                            cancel_url: obj["cancel_url"],
                            notify_url: obj["notify_url"],
                            order_id: obj["order_id"],
                            items: obj["item"],
                            amount: obj["amount"],
                            currency: obj["currency"],
                            hash: obj["hash"],
                            first_name: obj["first_name"],
                            last_name: obj["last_name"],
                            email: obj["email"],
                            phone: obj["phone"],
                            address: obj["address"],
                            city: obj["city"],
                            country: obj["country"],
                            delivery_address: "No. 46, Galle road, Kalutara South",
                            delivery_city: "Kalutara",
                            delivery_country: "Sri Lanka"
                        };

                        payhere.startPayment(payment);
                    } catch (e) {
                        alert("Invalid server response: " + e.message);
                    }
                }
            };
            xhttp.open("GET", "pay_now.php?fetch_payment=1", true);
            xhttp.send();
        }
    </script>
</body>
</html>
