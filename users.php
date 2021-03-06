<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
<!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title><link href="assets/css/bootstrap.css" rel="stylesheet" /><link href="assets/css/font-awesome.css" rel="stylesheet" /><link href="assets/css/style.css" rel="stylesheet" /><link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  </head>

  <body>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
    <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Manage Issued songs</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Issued songs
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User fName</th>
                                                    <th>User lName </th>
                                                    <th>DOB</th>
                                                    <th>Address</th>
                                                    <th>Add Friend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sid = $_SESSION['stdid'];
                                                // $sql = "SELECT tblsongs.songName,tblsongs.ISBNNumber,tblissuedsongdetails.IssuesDate,tblissuedsongdetails.ReturnDate,tblissuedsongdetails.id as rid,tblissuedsongdetails.fine from  tblissuedsongdetails join tblstudents on tblstudents.StudentId=tblissuedsongdetails.StudentId join tblsongs on tblsongs.id=tblissuedsongdetails.songId where tblstudents.StudentId=:sid order by tblissuedsongdetails.id desc";
                                                $sql = "SELECT * from  users";
                                                $query = $dbh->prepare($sql);
                                                // $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo htmlentities($result->id); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->fname); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->lname); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->dob); ?></td>
                                                            <td class="center"><?php if ($result->address == "") { ?>
                                                                    <span style="color:red">
                                                                        <?php echo htmlentities("Not Return Yet"); ?>
                                                                    </span>
                                                                <?php } else {
                                                                                    echo htmlentities($result->address);
                                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center"><?php echo htmlentities($result->address); ?></td>

                                                        </tr>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>



                </div>
            </div>
        </div>

  </body>

  </html>
<?php } ?>