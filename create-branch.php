<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
$branch_id=$_POST['branch_id'];
$branch_name = $_POST['b_name'];
$branch_city = $_POST['b_city'];
$distrcit = $_POST['district'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$branch_type = intval($_POST['branch_type']);
$sql= @"INSERT INTO tbl_branches (branch_id, b_name,b_city,district,username,password,type) 
        VALUES (:branch_id, :b_name, :b_city, :district, :username, :password, :branch_type)";
$query = $dbh->prepare($sql);
$query->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
$query->bindParam(':b_name', $branch_name, PDO::PARAM_STR);
$query->bindParam(':b_city', $branch_city, PDO::PARAM_STR);
$query->bindParam(':district', $district, POD::PARAM_STR);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->bindParam(':branch_type', $branch_type, PDO::PARAM_INT);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    $msg="Brnach Created successfully";
    header('location:manage-branch.php');
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin Create Branch</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar -->
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php include('includes/leftbar.php');?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Create Branch Details</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Branches</a></li>
            							<li class="active">Create Branch</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Create Branch Details</h5>
                                                </div>
                                            </div>
           <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
                                            <div class="panel-body">

                                                <form method="post">
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Branch ID</label>
                                                		<div class="">
                                                			<input type="text" name="branch_id" class="form-control" required="required" id="success">
                                                            <span class="help-block">Eg- SLTJ/BR/00..</span>
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">Branch Name</label>
                                                        <div class="">
                                                            <input type="text" name="b_name" required="required" class="form-control" id="success">
                                                            <span class="help-block">Eg- Akurana, Maligawatthe ..</span>
                                                        </div>
                                                    </div>
                                                     <div class="form-group has-success">
                                                        <label for="success" class="control-label">Branch City</label>
                                                        <div class="">
                                                            <input type="text" name="b_city" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>

                                                    <div class ="form-group has-success">
                                                        <label for="success" class="control-label">Select District</label>
                                                              <select class="form-control" name="district" title="Please Select a District">
                                                                <option value="Ampara">Ampara</option>
                                                                <option value="Anuradhapura">Anuradhapura</option>
                                                                <option value="Badulla">Badulla</option>
                                                                <option value="Batticaloa">Batticaloa</option>
                                                                <option value="Colombo">Colombo</option>
                                                                <option value="Galle">Galle</option>
                                                                <option value="Gampaha">Gampaha</option>
                                                                <option value="Hambantota">Hambantota</option>
                                                                <option value="Jaffna">Jaffna</option>
                                                                <option value="Kalutara">Kalutara</option>
                                                                <option value="Kandy">Kandy</option>
                                                                <option value="Kegalle">Kegalle</option>
                                                                <option value="Kilinochchi">Kilinochchi</option>
                                                                <option value="Kurunegala">Kurunegala</option>
                                                                <option value="Mannar">Mannar</option>
                                                                <option value="Matale">Matale</option>
                                                                <option value="Matara">Matara</option>
                                                                <option value="Moneragala">Moneragala</option>
                                                                <option value="Mullaitivu">Mullaitivu</option>
                                                                <option value="Nuwareliya">Nuwareliya</option>
                                                                <option value="Polonnaruwa">Polonnaruwa</option>
                                                                <option value="Puttalam">Puttalam</option>
                                                                <option value="Ratnapura">Ratnapura</option>
                                                                <option value="Trincomalee">Trincomalee</option>
                                                                <option value="Vavuniya">Vavuniya</option>
                                                            </select>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Username</label>
                                                        <div class="">
                                                            <input type="text" name="username" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Password</label>
                                                        <div class="">
                                                            <input type="password" name="password" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Confirm Password</label>
                                                        <div class="">
                                                            <input type="password" name="confirm_password" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>

                                                    <div class ="form-group has-success">
                                                        <label for="success" class="control-label">Branch Type</label>
                                                              <select class="form-control" name="branch_type" title="Please Select a District">
                                                                <option value="2">District Head</option>
                                                                <option value="3" selected>Regular Branch</option>
                                                            </select>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <div class="">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    </div>
                                                </form>                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->

                               
                               

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
