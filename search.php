<!DOCTYPE html>
<html>
    <head>
        <title> Library User System </title>
    </head>
<body>
    <?php
	
	$num= $_POST["cardnum"];
	
	//create my table with patron data
            $servername = "sql.njit.edu";
            $username = "th227";
            $password = "janice43";
            $dbname = "th227";
   
    $connect=mysqli_connect($servername, $username, $password, $dbname)
    OR die('Could not connect to MySQL' . mysqli_connect_error());
   
   if(isset($_POST['patron'])){
    $patron = "SELECT * FROM LibUsers WHERE Card_Number= \"" . $num . "\"";
	$responsePatron = mysqli_query($connect, $patron);
	if ($responsePatron){
		echo '<table align="left" border=\"1\"><tr><td align="left"><b> Patron Name</b></td>
		<td align="left"><b> Patron Card Number</b></td>
		<td align="left"><b> Patron Email</b></td>
		<td align="left"><b> Books Checked Out</b></td>
		<td align="left"><b> Book 1</b></td>
		<td align="left"><b> Due Date 1</b></td>
		<td align="left"><b> Book 2</b></td>
		<td align="left"><b> Due Date 2</b></td>
		<td align="left"><b> Book 3</b></td>
		<td align="left"><b> Due Date 3</b></td>
		<td align="left"><b> Book 4</b></td>
		<td align="left"><b> Due Date 4</b></td>
		<td align="left"><b> Book 5</b></td>
		<td align="left"><b>Due Date 5</b></td>';
		while($row = mysqli_fetch_array($responsePatron)){
			echo '<tr><td align="left">' . 
			$row['Patron_Name'] . '</td><td align = "left">' .
			$row['Card_Number'] . '</td><td align = "left">' .
			$row['Patron_Email'] . '</td><td align = "left">' .
			$row['Books_Checked_Out'] . '</td><td align = "left">' .
			$row['Book_1'] . '</td><td align = "left">' .
			$row['Due_Date1'] . '</td><td align = "left">' .
			$row['Book_2'] . '</td><td align = "left">' .
			$row['Due_Date2'] . '</td><td align = "left">' .
			$row['Book_3'] . '</td><td align = "left">' .
			$row['Due_Date3'] . '</td><td align = "left">' .
			$row['Book_4'] . '</td><td align = "left">' .
			$row['Due_Date4'] . '</td><td align = "left">' .
			$row['Book_5'] . '</td><td align = "left">' .
			$row['Due_Date5'] . '</td><td align = "left">' ;
			echo '</tr>';
		}
		echo '</table>';
	}
	else{
		echo "Could not display table";
		echo mysqli_error($connect);
}
}




?> 
</body>
</html>