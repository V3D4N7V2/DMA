<?php 

//require_once 'core.php';
require_once 'includes/config.php';
	
	$sql = "SELECT tblstudents.FullName,tblsongs.songName,tblsongs.ISBNNumber,tblsongs.id,tblissuedsongdetails.IssuesDate,tblissuedsongdetails.ReturnDate,tblissuedsongdetails.id as rid from  tblissuedsongdetails join tblstudents on tblstudents.StudentId=tblissuedsongdetails.StudentId join tblsongs on tblsongs.id=tblissuedsongdetails.songId order by tblissuedsongdetails.id desc";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Student Name</th>
			<th>songk Name</th>
			<th>songk ID</th>
			<th>ISBN Number</th>
			<th>Issued Date</th>
			<th>Return Date</th>
		</tr>

		<tr>';
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{  
			//echo"<script>alert('".$result->FullName."')</script>";
			$table .= '<tr>
				<td><center>'.$result->FullName.'</center></td>
				<td><center>'.$result->songName.'</center></td>
				<td><center>'.$result->id.'</center></td>
				<td><center>'.$result->ISBNNumber.'</center></td>
				<td><center>'.$result->IssuesDate.'</center></td>
				<td><center>'.$result->ReturnDate.'</center></td>
			</tr>';	
		}
		}
		$table .= '
		</tr>		
	</table>
	<button onClick="window.print()">Print this page</button>
	';	

	echo $table;



?>