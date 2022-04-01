<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{

$studentid=strtoupper($_POST['studentid']);
$songid=$_POST['songdetails'];
$sql="INSERT INTO  tblissuedsongdetails(StudentID,songId) VALUES(:studentid,:songid)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':songid',$songid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

$songid=$_GET['ISBNNumber'];
$studentid=$_GET['StudentID'];
$sql="DELETE FROM tblrequestedsongdetails WHERE StudentID=:studentid and ISBNNumber=:songid";
$query = $dbh->prepare($sql);
$query -> bindParam(':studentid',$studentid, PDO::PARAM_STR);
$query -> bindParam(':songid',$songid, PDO::PARAM_STR);
$query->execute();

$sql="update tblsongs set IssuedCopies=IssuedCopies+1 where ISBNNumber=:songid";
$query = $dbh->prepare($sql);
$query->bindParam(':songid',$songid,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="song issued successfully";
header('location:manage-issued-songs.php');

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new song</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for song details
function getsong() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_song.php",
data:'songid='+$("#songid").val(),
type: "POST",
success:function(data){
$("#get_song_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a New song</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New song
</div>
<div class="panel-body">





<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
<?php	
$songid=$_GET['ISBNNumber'];
$stdid=$_GET['StudentID'];
?>										
<div class="form-group">
<label>Student id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" value="<?php echo htmlentities($stdid);?>" onBlur="getstudent()" required />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>

<div class="form-group">
<label>songID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="booikid" id="songid" value="<?php echo htmlentities($songid);?>" onBlur="getsong()"  required="required" />
</div>

 <div class="form-group">
  song Title<select  class="form-control" name="songdetails" id="get_song_name" readonly> 
 </select>
 </div>
											
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<button type="submit" name="issue" id="submit" class="btn btn-info">Issue song </button>

										</form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
