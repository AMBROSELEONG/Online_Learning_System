<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['totalAmount']) && !empty($data['totalAmount'])) {
        $_SESSION['totalAmount'] = $data['totalAmount'];
        http_response_code(200);
    } else {
        // Handle the case where 'totalAmount' is missing or empty in the received data
        http_response_code(400);
    }
} else {
    http_response_code(405);
}
?>
