<?php
require_once dirname(__FILE__) . '/../../Midtrans.php';

\Midtrans\Config::$serverKey = "SB-Mid-server-Y9snq6Y6lcuQEq4J41n4kpMy";
\Midtrans\Config::$isProduction = false;   // false = sandbox
$order = "2115179225";
$order_status_obj = \Midtrans\Transaction::status($order);
$status = $order_status_obj->transaction_status;
echo $status.'<br>';
print_r($order_status_obj);
?>