<?php

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$amount = 1000;
$merchant_id = "1230108";
$order_id = uniqid();
$merchant_secret = "MTQ5NjkyMTIyMzIwMDUxMTMwNTM1MjU4NDc2NzgxOTg3MjYxMzc=";
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array["amount"] = $amount;
$array["item"] = "Item1";
$array["first_name"] = "Saman";
$array["last_name"] = "Perera";
$array["email"] = "samanperera@gmail.com";
$array["phone"] = "0771234567";
$array["address"] = "No.1, Galle Road";
$array["city"] = "Colombo";
$array["country"] = "Sri Lanka";
$array["delivery_address"] = "No. 46, Galle road, Kalutara South";
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["hash"] = $hash;

$jsonObj = json_encode($array);
echo $jsonObj;
?>