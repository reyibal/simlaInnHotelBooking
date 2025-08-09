<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('payhere_config/config_payhere.php');

date_default_timezone_set("Asia/Colombo");

session_start();
unset($_SESSION['room']);

function regenerate_session($uid){
    $user_q=select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$uid],'i');
    $user_fetch = mysqli_fetch_assoc($user_q);

    $_SESSION['login'] = true;
    $_SESSION['uID'] = $user_fetch['id'];
    $_SESSION['uName'] = $user_fetch['name'];
    $_SESSION['uPic'] = $user_fetch['profile'];
    $_SESSION['uPhone'] = $user_fetch['phonenum'];
    echo 1;
}

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$slct_query = "SELECT `booking_id`, `user_id` FROM `booking_order`
    WHERE `order_id`='$_POST[order_id]'";

$slct_res = mysqli_query($con,$slct_query);

$slct_fetch = mysqli_fetch_assoc($slct_res);

if(mysqli_num_rows($slct_res)==0){
    redirect('index.php');
}
// Check if the order ID matches the session data
if (!isset($_SESSION['form_data']) || !isset($_SESSION['room'])) {
    regenerate_session($slct_fetch['user_id']);
}  

if ($_POST['status_code'] == 2)
    {
        $FORMATTED_AMOUNT = $_POST['payhere_amount'];
        $ORDER_ID = $_POST['order_id'];
        $PAYHERE_MERCHANT_ID = $_POST['merchant_id'];
        $PAYHERE_CURRENCY = $_POST['payhere_currency'];
        $STATUS_CODE = $_POST['status_code'];
        $MD5SIG = $_POST['md5sig'];

        // Update booking status in the database
        $query = "UPDATE `booking_order` SET `booking_status`='booked',`trans_amount`='$_POST[payhere_amount]',
        `trans_status`='$_POST[status_code]',`trans_resp_msg`='$_POST[status_message]'
        WHERE `booking_id`='$slct_fetch[booking_id]'";

        mysqli_query($con, $query);
    }
else if($_POST['status_code'] == -2)
    {
        $query = "UPDATE `booking_order` SET `booking_status`='payment failed',`trans_amount`='$_POST[payhere_amount]',
        `trans_status`='$_POST[status_code]',`trans_resp_msg`='$_POST[status_message]'
        WHERE `booking_id`='$slct_fetch[booking_id]'";

        mysqli_query($con, $query);
    }
    redirect('pay_status.php?order='.$_POST['order_id']);
    exit;