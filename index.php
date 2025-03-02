<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    
    $merchant_id = "YOUR_MERCHANT_ID";
    $public_key = "YOUR_PUBLIC_KEY";
    $secret_key = "YOUR_SECRET_KEY";
    $order_id = uniqid();
    $redirect_url = "http://" . $_SERVER['HTTP_HOST'] . "/Sample-php-UPITranzact/check_status.php?order_id=" . $order_id;
    
    $postData = [
        "mid" => $merchant_id,
        "amount" => $amount,
        "order_id" => $order_id,
        "redirect_url" => $redirect_url,
        "note" => "Add money",
        "customer_name" => "John",
        "customer_email" => $email,
        "customer_mobile" => $phone
    ];
    
    $ch = curl_init("https://api.upitranzact.com/v1/payments/createOrderRequest");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Basic " . base64_encode("$public_key:$secret_key"),
        "Content-Type: application/json"
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $responseData = json_decode($response, true);
    if ($responseData["status"] && isset($responseData["data"]["payment_url"])) {
        header("Location: " . $responseData["data"]["payment_url"]);
        exit();
    } else {
        echo "<h3>Payment Error:</h3><pre>$response</pre>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }
        input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Secure Payment</h2>
        <form method="post">
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label>Phone:</label>
                <input type="text" name="phone" required>
            </div>
            <div class="input-group">
                <label>Amount:</label>
                <input type="number" name="amount" required>
            </div>
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>


