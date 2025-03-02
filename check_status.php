<?php
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $merchant_id = "YOUR_MERCHANT_ID";
    $public_key = "YOUR_PUBLIC_KEY";
    $secret_key = "YOUR_SECRET_KEY";

    $statusData = [
        "mid" => $merchant_id,
        "order_id" => $order_id
    ];
    
    $ch = curl_init("https://api.upitranzact.com/v1/payments/checkPaymentStatus");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($statusData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Basic " . base64_encode("$public_key:$secret_key"),
        "Content-Type: application/json"
    ]);
    
    $statusResponse = curl_exec($ch);
    curl_close($ch);
    
    echo "<h3>Payment Status:</h3><pre>$statusResponse</pre>";
} else {
    echo "<h3>Error:</h3> Missing order ID.";
}
?>
