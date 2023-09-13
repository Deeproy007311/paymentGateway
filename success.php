<?php
// Check if the required POST data is present
if (isset($_POST['razorpay_order_id']) && isset($_POST['razorpay_payment_id']) && isset($_POST['razorpay_amount'])) {
    // Get the POST data from Razorpay
    $order_id = $_POST['razorpay_order_id'];
    $payment_id = $_POST['razorpay_payment_id'];
    $amount = $_POST['razorpay_amount'];

    // Validate the payment data (e.g., check if the payment amount matches the expected amount)
    $expected_amount = $_POST['amount'] * 100; // Convert to the same format as Razorpay
    if ($amount == $expected_amount) {
        // Database connection code (as previously shown)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "paymentgateway_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert the payment data into the database
        $sql = "INSERT INTO `payments` (`order_id`, `payment_id`, `payment_amount`,` payment_status`) VALUES ('$order_id', '$payment_id', '$amount', 'success')";

        if ($conn->query($sql) === TRUE) {
            echo "Payment data has been successfully stored in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Payment data validation failed. Amount mismatch.";
    }
} else {
    echo "Required POST data is missing.";
}
?>
