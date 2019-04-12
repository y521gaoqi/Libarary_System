<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con){
  die('Could not connect: ' . mysql_error());
}

$Isbn=str_pad($Isbn,10,"0",STR_PAD_LEFT);

$num_borrowed_books=$con->query("Select num_books from BORROWER where Card_id='$Card_id'");

$Isbn = $_GET['Isbn'];
$Title = $_GET['Title'];
$Name = $_GET['borrower_Name'];
$Card_id = $_GET['card_Id'];
$Loan_Id = $_GET['loan_Id'];
echo "$Loan_Id";

$Date_in=date('Y-m-d');
echo "$Date_in";
$sql = "UPDATE BOOK_LOANS SET Date_in='$Date_in' WHERE Loan_id='$Loan_Id'";
//$con->query($sql);
if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $con->error;
}




?>