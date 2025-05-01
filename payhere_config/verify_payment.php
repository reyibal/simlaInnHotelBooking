<?php
require("config_payhere.php");
require("inc/db_config.php"); // your DB connection file

$merchant_id = $_POST['merchant_id'];
$order_id = $_POST['order_id'];
$payhere_amount = $_POST['payhere_amount'];
$payhere_currency = $_POST['payhere_currency'];
$status_code = $_POST['status_code'];
$md5sig = $_POST['md5sig'];

$local_booking = $_SESSION['booking'] ?? null;

if (!$local_booking || $order_id !== $local_booking['order_id']) {
    http_response_code(400);
    exit("Booking not found.");
}

// Re-generate signature
$local_sig = strtoupper(
    md5(
        PAYHERE_MERCHANT_ID .
        $order_id .
        number_format($payhere_amount, 2, '.', '') .
        $payhere_currency .
        $status_code .
        strtoupper(md5(PAYHERE_MERCHANT_SECRET))
    )
);

if ($md5sig !== $local_sig) {
    http_response_code(403);
    exit("Signature mismatch.");
}

if ((int)$status_code === 2) {
    // Mark booking as paid in DB
    $query = "INSERT INTO booking_order (user_id, room_id, check_in, check_out, order_id, amount, booking_status)
              VALUES (?, ?, ?, ?, ?, ?, 'paid')";
    insert($query, [
        $local_booking['user_id'],
        $local_booking['room_id'],
        $local_booking['checkin'],
        $local_booking['checkout'],
        $local_booking['order_id'],
        $payhere_amount
    ], 'iisssd');
}