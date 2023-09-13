<?php
if (isset($_POST['razorpay_order_id']) && isset($_POST['razorpay_payment_id']) && isset($_POST['razorpay_amount'])) {
    $order_id = $_POST['razorpay_order_id'];
    $payment_id = $_POST['razorpay_payment_id'];
    $amount = $_POST['razorpay_amount'];

    $expected_amount = $_POST['amount'] * 100; 
    if ($amount == $expected_amount) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "paymentgateway_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO `payments` (`order_id`, `payment_id`, `payment_amount`,` payment_status`) VALUES ('$order_id', '$payment_id', '$amount', 'success')";

        if ($conn->query($sql) === TRUE) {
            echo "Payment data has been successfully stored in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Payment data validation failed. Amount mismatch.";
    }
} else {
    echo "Required POST data is missing.";
}
?>
