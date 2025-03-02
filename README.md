# UPITranzact Payment Integration (PHP)

This repository provides a simple implementation of integrating UPITranzact payment gateway using PHP.

## Features
- Secure payment form
- Order creation via UPITranzact API
- Redirects user to payment gateway
- Payment status check

## Prerequisites
- A UPITranzact merchant account
- Your API credentials:
  - Merchant ID
  - Public Key
  - Secret Key
- PHP 7+ installed on your server

## Installation
1. Clone this repository or download the files.
2. Open the `create_order.php` file and replace the following placeholders with your actual credentials:
   ```php
   $merchant_id = "YOUR_MERCHANT_ID";
   $public_key = "YOUR_PUBLIC_KEY";
   $secret_key = "YOUR_SECRET_KEY";
   ```
3. Ensure your server supports cURL.
4. Place the files in your server's public directory.

## Usage
### Step 1: Open the Payment Form
1. Open `index.php` in your browser.
2. Fill in the email, phone, and amount fields.
3. Click "Pay Now" to proceed.

### Step 2: Payment Processing
- The form submits data to the server.
- The backend creates an order via UPITranzact API.
- The user is redirected to the UPITranzact payment page.

### Step 3: Check Payment Status
- After payment, the user is redirected to `check_status.php`.
- The script verifies the payment status using UPITranzact API.
- The response displays the transaction status.

## API Endpoints Used
### Create Order Request
**Endpoint:** `https://api.upitranzact.com/v1/payments/createOrderRequest`

**Method:** `POST`

**Headers:**
```http
Authorization: Basic base64_encode("public_key:secret_key")
Content-Type: application/json
```

### Check Payment Status
**Endpoint:** `https://api.upitranzact.com/v1/payments/checkPaymentStatus`

**Method:** `POST`

**Headers:**
```http
Authorization: Basic base64_encode("public_key:secret_key")
Content-Type: application/json
```

## License
This project is licensed under the MIT License.
