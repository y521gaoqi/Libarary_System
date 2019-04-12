<?php
$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//echo"123";
  $key_word=$_GET['checkIn'];
//  echo "$key_word";

$sql = "SELECT DISTINCT BOOK.Isbn, BOOK_LOANS.Loan_id, BOOK.Title, BOOK_LOANS.Card_id, BORROWER.Ssn, BORROWER.Bname, BOOK_LOANS.Date_out, BOOK_LOANS.Due_date from (BOOK left join BOOK_LOANS on BOOK.Isbn=BOOK_LOANS.Isbn) left join BORROWER on BORROWER.Card_id=BOOK_LOANS.Card_id where (BORROWER.Bname like '%$key_word%' or BOOK_LOANS.Loan_id='$key_word' or BOOK_LOANS.Isbn='$key_word' or BOOK_LOANS.Card_id='$key_word' or BORROWER.Bname='%$key_word%' or BORROWER.Phone='$key_word') and (BOOK_LOANS.Date_in IS NULL)";
  

  //"SELECT book_loans.Loan_id, BOOK.Isbn, BOOK.Title, BORROWER.Ssn, BORROWER.Bname from (BOOK left join BOOK_LOANS on BOOK.Isbn=BOOK_LOANS.Isbn) left join BORROWER on BORROWER.Card_id=BOOK_LOANS.Card_id where BORROWER.Bname='%$key_word%'";
  

  //BOOK_LOANS.Loan_id='$key_word' or BOOK_LOANS.Isbn='$key_word' or BOOK_LOANS.Card_id='$key_word' or BORROWER.Bname='%$key_word%' or BORROWER.Phone='$key_word'"

  $result = $con->query($sql);

if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {
      	echo "Isbn: " . $row["Isbn"] . "<br>";
      	echo "Title: " . $row["Title"] . "<br>";
      	echo "Borrower Name: " . $row["Bname"] . "<br>";
      	echo "Check Out date: " . $row["Date_out"] . "<br>";
      	echo "Due Date: " . $row["Due_date"] . "<br>";

      	echo "<form action='checkIn_record.php' method='get'>";
      	echo"<input type='hidden' name='Isbn' value='$row[Isbn]'/>
    	<input type='hidden' name='Title' value='$row[Title]'/>
      	<input type='hidden' name='borrower_Name' value='$row[Bname]'/>
      	<input type='hidden' name='card_Id' value='$row[Card_id]'/>
      	<input type='hidden' name='loan_Id' value='$row[Loan_id]'/>
		<input type='submit' name='name' value='Check In'>";
		echo"</form>";
  	}
}


?>

