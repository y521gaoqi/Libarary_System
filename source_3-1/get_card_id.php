<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$Isbn = $_GET['Isbn'];
$Title = $_GET['Title'];
$Author = $_GET['Author'];
$Availability = $_GET['Availability'];

$Isbn=str_pad($Isbn,10,"0",STR_PAD_LEFT);
//echo $Isbn;

$if_exists=$con->query("SELECT Loan_id from BOOK_LOANS where Isbn='$Isbn'");

if(mysqli_num_rows($if_exists)>0){
	echo "<script language='javascript'>document.location = 'book_not_availability.html'</script>";
}else if($Availability==0){
	echo "<script language='javascript'>document.location = 'book_not_availability.html'</script>";
}else{
	echo "<form action='selected_book.php' method='get'>";
	echo"<input type='hidden' name='Isbn' value='$Isbn'/>
	Input your Card ID: <input type='tel' name='card_id' onkeypress='return event.keyCode>=48 && event.keyCode<=57' ng-pattern='/[^a-zA-Z]/'/>
	<input type='hidden' name='Title' value='$Title'/>
	<input type='hidden' name='Author' value='$Author'/>
	<input type='hidden' name='Availability' value='$Availability'/>
	<input type='submit' name='submit' value='Submit'>";
	echo"</form>";
}






?>
