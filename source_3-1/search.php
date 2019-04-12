<?php
$con = new mysqli("127.0.0.1","root","1314521","LIBRARY");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$key_word=$_GET['book_search'];

$sql = "select DISTINCT book.Title,book.Isbn,AUTHORS.Author, Book.Availability from (book left join BOOK_AUTHORS on Book.isbn=BOOK_AUTHORS.Isbn) left join authors on BOOK_AUTHORS.Author_id=AUTHORS.Author_id where BOOK.Title like '%$key_word%' or Authors.Author like '%$key_word%' or book.Isbn='$key_word'";


$result = $con->query($sql);

echo "<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'> 
  <title>BOOK Results</title>
  <link rel='stylesheet' href='https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>  
  <script src='https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js'></script>
  <script src='https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>
<body>

<table class='table table-striped'>
  <caption>Results</caption>
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Availability</th>
    </tr>
  </thead>
  <tbody>";
    if ($result->num_rows > 0) {
  
    while($row = $result->fetch_assoc()) {
      echo"<tr>
          <td>". $row['Isbn'] . "</td>";
      echo"<td>". $row['Title'] . "</td>";
      echo"<td>". $row['Author'] . "</td>";
      echo"<td>"; 
      if($row["Availability"]==1){
        echo "It is available" . "<br>";
      }else{
        echo "It is not available" . "<br>";
      }
      echo "</td>";

      echo "<td>";
      echo "<form action='get_card_id.php' method='get'>";
      echo"<input type='hidden' name='Isbn' value='$row[Isbn]'/>
      <input type='hidden' name='Title' value='$row[Title]'/>
      <input type='hidden' name='Author' value='$row[Author]'/>
      <input type='hidden' name='Availability' value='$row[Availability]'/>
      <input type='submit' name='submit' value='Check Out'>";
      echo"</form>";
      echo"</td>" .
          "</tr>" . "</tbody>";
      // echo "id: " . $row["Isbn"] . "<br>";
      // echo "Title: " . $row["Title"] . "<br>";
      // echo "Author: " . $row["Author"] . "<br>";
      // if($row["Availability"]==1){
      //   echo "It is available" . "<br>";
      // }else{
      //   echo "It is not available" . "<br>";
      // }
      // echo "<form action='get_card_id.php' method='get'>";
      // echo"<input type='hidden' name='Isbn' value='$row[Isbn]'/>
      // <input type='hidden' name='Title' value='$row[Title]'/>
      // <input type='hidden' name='Author' value='$row[Author]'/>
      // <input type='hidden' name='Availability' value='$row[Availability]'/>
      // <input type='submit' name='submit' value='Check Out'>";
      // echo"</form>";
      
    }
    
}
else {
    echo "0 result";
}

    echo"
</table>

</body>
</html>";



/*if ($result->num_rows > 0) {
echo "<table border='1'>
<tr>
<th>Isbn</th>
<th>Title</th>
</tr>";

while($row = $result->fetch_assoc())
  {
  echo "<tr>";
  echo "<td>" . $row['Isbn'] . "</td>";
  echo "<td>" . $row['Title'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
}else {
    echo "0 result";
}
*/


// if ($result->num_rows > 0) {
	
//     while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["Isbn"] . "<br>";
//       echo "Title: " . $row["Title"] . "<br>";
//       echo "Author: " . $row["Author"] . "<br>";
//       if($row["Availability"]==1){
//         echo "It is available" . "<br>";
//       }else{
//         echo "It is not available" . "<br>";
//       }
//     	echo "<form action='get_card_id.php' method='get'>";
//     	echo"<input type='hidden' name='Isbn' value='$row[Isbn]'/>
//     	<input type='hidden' name='Title' value='$row[Title]'/>
//       <input type='hidden' name='Author' value='$row[Author]'/>
//       <input type='hidden' name='Availability' value='$row[Availability]'/>
// 		  <input type='submit' name='submit' value='Check Out'>";
// 		  echo"</form>";
      
//     }
    
// }
// else {
//     echo "0 result";
// }


$con->close();

?>