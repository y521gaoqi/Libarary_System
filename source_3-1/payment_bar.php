<?php


$Fine_amt = $_GET['fine_amt'];

echo "<form action='make_payment.php' method='get'>";
echo "You owe "; echo $Fine_amt . "<br>";
echo "Input payment amount: <input type='text' name='payment_amt'>
<input type='hidden' name='fine_amt' value = '$Fine_amt'>
<input type='submit' name='Search' value='PAY NOW'>
</form>";


?>