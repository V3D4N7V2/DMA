<?php 
require_once("includes/config.php");
if(!empty($_POST["songid"])) {
  $songid=$_POST["songid"];
 
    $sql ="SELECT songName,id FROM tblsongs WHERE ISBNNumber=:songid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':songid', $songid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
  foreach ($results as $result) {?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->songName);?></option>
<b>songk Name :</b> 
<?php  
echo htmlentities($result->songName);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
 else{?>
  
<option class="others"> Invalid ISBN Number</option>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
?>
