<?php
	include("db.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training || Course list</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 58px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Course list</a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  	</button>

		  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
		      	<li class="nav-item active">
		        	<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="#">About</a>
		      	</li>
		    	<?php
		    		if (isset($_SESSION["userID"]))
		    		{
		    			?>
		    			<li class="nav-item">
		        			<a class="nav-link" href="#"><?=$_SESSION["userID"];?></a>
		    			</li>
		    			<li>
			    			<a class="nav-link" href="logout.php" onclick="return confirm('Do you want to logout?')">Logout</a>
			    		</li>
			    		<?php
			    	}
			    	else
			    	{
			    		?>
			    		<li class="nav-item">
		        			<a class="nav-link" href="#">Account</a>
		    			</li>
		    			<?php
			    	}
		    	?>
		  </div>
		</div>
	</nav>
	<main>
		<form action="" method="POST" name="frmAssign">
			<table align="center">
				<tr align="center">
					<th colspan="2" class="h3">Course details</th>
				</tr>
					<?php
					$courseID = $_REQUEST["courseID"];
					$query = "SELECT * FROM course WHERE courseID = '".$courseID."'";
					$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
					$row = mysqli_fetch_assoc($result);
					?>
				<tr>
					<td>
						Course ID:
					</td>
					<td>
						<input type="text" class="form-control" name="txtCourseID" value="<?=$row['courseID'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Topic ID:
					</td>
					<td>
						<input type="text" class="form-control" name="txtTopicID" value="<?=$row['topicID'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Category Type:
					</td>
					<td>
						<input type="text" class="form-control" name="txtCategoryType" value="<?=$row['categoryType'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Trainer ID:
					</td>
					<td>
						<input type="text" class="form-control" name="txttrainerID" value="<?=$row['trainerID'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Course start date:
					</td>
					<td>
						<input type="date" class="form-control" name="txtStartDate" value="<?=$row['courseStartDate'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Course end date:
					</td>
					<td>
						<input type="date" class="form-control" name="txtEndDate" value="<?=$row['courseEndDate'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Course location:
					</td>
					<td>
						<input type="text" class="form-control" name="txtLocation" value="<?=$row['courseLocation'];?>" readonly="true">
					</td>
				</tr>
				<tr>
					<td>
						Course content:
					</td>
					<td>
						<textarea name="txtCourseContent" id="" cols="30" rows="2" placeholder="<?=$row['courseContent']?>" value="<?=$row['courseContent']?>" class="form-control" readonly="true"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">--------------------------------------------------------------</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<a href="../traineepage.php"><input type="button" value="Back to previous page" name="btnBack" class="btn btn-primary"></a>
					</td>
				</tr>
			</table>
		</form>
	</main>
	<br>
  <!-- Footer Links -->
  <footer class=" bg-dark page-footer font-small blue pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left ">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">BTEC FPT</h5>
        <p class="text-white">Luôn luôn lắng nghe - Lâu lâu mới hiểu</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Contact Us</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Address : 133 xuân thủy , HN</a>
          </li>
          <li>
            <a href="#!">Phone : +84 0123456</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">WEB</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Zalo</a>
          </li>
          <li>
            <a href="#!">FaceBook</a>
          </li>
          <li>
            <a href="#!">Instagram</a>
          </li>
          <li>
            <a href="#!">Twitter</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-white">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>