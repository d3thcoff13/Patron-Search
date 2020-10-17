<!DOCTYPE html>
<html>
    <head>
        <title> Book Search </title>
    </head>
<body>
    <?php
	
	$author= $_POST['author'];
	
	//create my table with patron data
            $servername = "sql.njit.edu";
            $username = "th227";
            $password = "janice43";
            $dbname = "th227";
   
    $connect=mysqli_connect($servername, $username, $password, $dbname)
    OR die('Could not connect to MySQL' . mysqli_connect_error());
   
   if(isset($_POST['books'])){
    $patron = "SELECT * FROM Books WHERE Author= \"" . $author . "\" OR Title =\"" . $_POST['title'] . "\" OR Call_Number= \"" . $_POST['callnum'] . "\"";
	$responsePatron = mysqli_query($connect, $patron);
	if ($responsePatron){
		echo '<table align="left" border = \"1\"><tr><td align="left"><b>Title</b></td>
		<td align="left"><b>Author</b></td>
		<td align="left"><b>Call Number</b></td>';
		while($row = mysqli_fetch_array($responsePatron)){
			echo '<tr><td align="left">' . 
			$row['Title'] . '</td><td align = "left">' .
			$row['Author'] . '</td><td align = "left">' .
			$row['Call_Number'] . '</td><td align = "left">';
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