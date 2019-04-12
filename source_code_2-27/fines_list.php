<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}

$all_Loans=$con->query("SELECT * from BOOK_LOANS");


if ($all_Loans->num_rows > 0) {
	
    while($row = $all_Loans->fetch_assoc()) {
    	if(!is_null($row["Date_in"])){
    		$date1=$row["Due_date"];
            $date2=$row["Date_in"];
            if(strtotime($date1)<strtotime($date2)){
                $if_exists_loan=$con->query("SELECT Loan_id from FINES where Loan_id='$row[Loan_id]'");
                if(mysqli_num_rows($if_exists_loan)>0){


                }
                else
                {
                    $Days = (strtotime($date2)-strtotime($date1))/3600/24;
                    $Fine="$" . $Days*0.25;
                    
                    //echo "22222";
                    if ($con->query("INSERT INTO FINES (Loan_id, Fine_amt) VALUES ('$row[Loan_id]', '$Fine')") === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                }
            }
    	
    	}
    	if(is_null($row["Date_in"]))
        {
            $date1=$row["Due_date"];
            $date2=$date["Y-m-d"];
            //echo $date2 . "<br>";
            if(strtotime($date1)<strtotime($date2)){

                $if_paid=$con->query("SELECT * from FINES where Loan_id='$row[Loan_id]'");
                if (mysqli_num_rows($if_paid)>0){
                    $paid_row = $if_paid->fetch_assoc();
                    if($paid_row['Paid']==0){
                        $Days = (strtotime($date2)-strtotime($date1))/3600/24;
                        $Fine="$" . $Days*0.25;
                        $con->query("UPDATE FINES SET Fine_amt='$Fine' WHERE Loan_id='$row[Loan_id]'");
                    }
                }
                else{
                    $Days = (strtotime($date2)-strtotime($date1))/3600/24;
                    $Fine="$" . $Days*0.25;
                    $con->query("INSERT INTO FINES (Loan_id, Fine_amt) VALUES ('$row[Loan_id]', '$Fine')");
                }
                

                
            }
    	}


    }
}


$fine_list=$con->query("SELECT * from FINES");
if ($fine_list->num_rows > 0) {
    
    while($row = $fine_list->fetch_assoc()) {
        if ($row[Paid]==0){
            $book_info=$con->query("SELECT BOOK.Title FROM BOOK WHERE BOOK.Isbn=(SELECT BOOK_LOANS.Isbn from BOOK_LOANS where BOOK_LOANS.Loan_id='$row[Loan_id]')");
            $row_book_info=$book_info->fetch_assoc();
            echo $row_book_info[Title] . "<br>";
            echo $row[Loan_id] . "<br>";
            echo $row[Fine_amt] . "<br>";
            //echo $row[Paid] . "<br>";
            echo "<form action='make_payment.php' method='get'>";
            echo"<input type='hidden' name='loan_id' value='$row[Loan_id]'/>
            <input type='hidden' name='fine_amt' value='$row[Fine_amt]'/>
            <input type='submit' name='submit' value='Pay Now'>";
            echo"</form>";
            echo "<br>";
        }
        
    }
}
?>



