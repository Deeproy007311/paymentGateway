<?php
$apikey = "rzp_test_wsDsUFIo1TqJYB";
?>
<?php include '_dbconnect.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<form action="success.php" method="post">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'post') {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}
?>
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apikey; ?>" 
    data-amount="<?php echo $_POST['amount']*100; ?>" 
    data-currency="INR"
    data-id="<?php echo $_POST['orderid']; ?>"
    data-buttontext="Pay with Razorpay"
    data-name="Course"
    data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
    data-image="https://example.com/your_logo.jpg"
    data-prefill.name="<?php echo $_POST['name'] ?>"
    data-prefill.email="<?php echo $_POST['email'] ?>"
    data-prefill.contact="<?php echo $_POST['mobile'] ?>"
    data-theme.color="#279EFF"
></script>
<input type="hidden" custom="Hidden Element" name="hidden"/>
</form>

<style>
    .razorpay-payment-button{
        display: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.razorpay-payment-button').click();
    });
</script>