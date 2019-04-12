<?php

$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con){
  die('Could not connect: ' . mysql_error());
}

$Ssn_1 = $_GET['ssn-1'];
$Ssn_2 = $_GET['ssn-2'];
$Ssn_3 = $_GET['ssn-3'];
$Ssn=$Ssn_1 . "-"  . $Ssn_2 . "-" . $Ssn_3;
$Name = $_GET['name'];
$Address = $_GET['address'];
$Phone = $_GET['phone'];

//$Ssn=str_replace("-","",$Ssn);
//$Ssn=str_pad($Ssn,9,"0",STR_PAD_LEFT);

$Card_id=$con->query("Select Card_id from BORROWER where Ssn='$Ssn'");
//$row = $Card_id->fetch_assoc();
//echo $row["Card_id"] . "<br>";

$num_rows=mysqli_num_rows($Card_id);
if($num_rows>0){
	echo "<script language='javascript'>document.location = 'fail_page.html'</script>";
}else{
	$sql = "INSERT INTO BORROWER (Ssn,Bname,Address,Phone) VALUES ('$Ssn','$Name','$Address','$Phone')";
	$con->query($sql);
	// if ($con->query($sql) === TRUE) {
 //    	echo "Record updated successfully";
	// } else {
 //    	echo "Error updating record: " . $con->error;
	// }
}
?>