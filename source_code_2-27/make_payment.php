<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}


$Loan_id=$_GET['loan_id'];
$Fine_amt=$_GET['fine_amt'];
echo $Loan_id;

if($Payment_amt<$Fine_amt){
	$sql = "UPDATE FINES SET Paid='1' WHERE Loan_id='$Loan_id'";
	//$con->query($sql);
		if ($con->query($sql) === TRUE) {
    	echo "Record updated successfully";
	} else {
    	echo "Error updating record: " . $con->error;
	}
}


?>