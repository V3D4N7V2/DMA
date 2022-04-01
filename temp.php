<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	$StudentID = $_GET['StudentID'];
	$StudName = $_GET['StudName'];
	$ISBNNumber = $_GET['ISBNNumber'];
	$songName = $_GET['songName'];
	$AuthorName = $_GET['AuthorName'];
	$CategoryName = $_GET['CategoryName'];
	$songPrice = $_GET['songPrice'];

	$sql = "SELECT * from tblrequestedsongdetails where StudentID=:StudentID and ISBNNumber=:ISBNNumber";
	$query = $dbh->prepare($sql);
	$query->bindParam(':StudentID', $StudentID, PDO::PARAM_STR);
	$query->bindParam(':ISBNNumber', $ISBNNumber, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	$cnt = 1;
	if ($query->rowCount() > 0) {
		$_SESSION['msg'] = "You have already requested this song";
		header('location:request-a-song.php');
	} else {
		$sql = "SELECT * from tblrequestedsongdetails where StudentID=:StudentID";
		$query = $dbh->prepare($sql);
		$query->bindParam(':StudentID', $StudentID, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() == 2) {
			$_SESSION['msg'] = "You cannot request more than 2 songs at a time";
			header('location:request-a-song.php');
		} else {
			$sql = "INSERT INTO tblrequestedsongdetails(StudentID,StudName,songName,CategoryName,AuthorName,ISBNNumber,songPrice) VALUES(:StudentID,:StudName,:songName,:CategoryName,:AuthorName,:ISBNNumber,:songPrice)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':StudentID', $StudentID, PDO::PARAM_STR);
			$query->bindParam(':StudName', $StudName, PDO::PARAM_STR);
			$query->bindParam(':songName', $songName, PDO::PARAM_STR);
			$query->bindParam(':CategoryName', $CategoryName, PDO::PARAM_STR);
			$query->bindParam(':AuthorName', $AuthorName, PDO::PARAM_STR);
			$query->bindParam(':ISBNNumber', $ISBNNumber, PDO::PARAM_STR);
			$query->bindParam(':songPrice', $songPrice, PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			$_SESSION['msg'] = "song requested successfully";
			header('location:request-a-song.php');
		}
	}
}
