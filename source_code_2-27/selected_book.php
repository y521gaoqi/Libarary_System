<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$Isbn = $_GET['Isbn'];
$Isbn=str_pad($Isbn,10,"0",STR_PAD_LEFT);


$if_exists=$con->query("SELECT Loan_id from BOOK_LOANS where Isbn='$Isbn'");
/*while($row = $result->fetch_assoc()) {
      echo "id: " . $row["Loan_id"] . "<br>";
      }
*/
if(mysqli_num_rows($if_exists)>0){
	echo "<script language='javascript'>document.location = 'fail_page.html'</script>";
}
else{
	$num_borrowed_books=$con->query("Select num_books from BORROWER where Card_id='$Card_id'");


	$Title = $_GET['Title'];
	$Author = $_GET['Author'];
	$Availability = $_GET['Availability'];

	$update_avai="UPDATE BOOK SET Availability='0' WHERE Isbn='$Isbn'";
	$con->query($update_avai);
/*
if ($con->query($update_avai) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $con->error;
}
*/

	$Card_id = $_GET['card_id'];
	$Card_id=str_pad($Card_id,6,"0",STR_PAD_LEFT);
	$num_borrowed_books=$con->query("Select Num_Books from BORROWER where Card_id='$Card_id'");
	$row = $num_borrowed_books->fetch_assoc();
	if($row["Num_Books"]>=3){
		echo "<script language='javascript'>document.location = 'fail_page.html'</script>";
	}
	else{
		$updated_num_borrowed_books=$row["Num_Books"]+1;
		//echo $updated_num_borrowed_books . "<br>";
		$con->query("UPDATE BORROWER SET Num_Books='$updated_num_borrowed_books' where Card_id='$Card_id'");


		$Date_out=date('Y-m-d');
		$Due_date = date('Y-m-d', strtotime("+15 day"));
		$sql = "INSERT INTO BOOK_LOANS (Isbn,Card_id,Date_out,Due_date) VALUES ('$Isbn','$Card_id','$Date_out','$Due_date')";
		$con->query($sql);
		echo "Sucessfully Checked out";

	}
}






?>