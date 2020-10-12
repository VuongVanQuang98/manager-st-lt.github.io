<?php
	include("db.php");
	require("authTrainerPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training  || List of assigned trainee</title>
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
			<a class="navbar-brand" href="#">Assigned trainee list</a>
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
				    			<a class="nav-link" href="logout.php" onclick="return confirm('Do you want to logout? Your work is not saved?')">Logout</a>
				    		</li>
			    		<?php
			    	}
			    	else
			    	{
			    		?>
			    		<script>
			    			alert("You must login first");
			    			location.assign('http://localhost/ASM/index.php');
			    		</script>

		    			<?php
			    	}
		    	?>
		  </div>
		</div>
	</nav>
	<main>
		<form action="" method="POST" name="frmViewAssign">
			<table class="table-dark" border="1" width="50%" align="center" style="overflow: scroll; height: 400px">
				<thead>
					<tr>
						<th>Order No</th>
						<th>Course ID:</th>
						<th>Student ID:</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$courseID = $_REQUEST["courseID"];
						$array = $_SESSION["trainee"];
						for ($i = 0; $i < count($array); $i ++)
						{
							?>
								<tr align="center">
									<td align="center"><?=$i + 1?></td>
									<td align="center"><?=$courseID?></td>
									<td align="center"><?=$array[$i]?></td>
									<td align="center"><a href="">Remove</a></td>
								</tr>
							<?php
						}
					?>
					<tr>
						<td colspan="4" align="center">
							<input type="submit" value="Save" name="btnSave" class="btn btn-primary">
							<input type="submit" value="Cancel" name="btnCancel" class="btn btn-primary" onclick="return confirm('Do you really not want to save data?')">
							<a href="trainerAssign.php?courseID=<?=$courseID?>"><input type="button" name="btnBack" value="Back" class="btn  btn-primary"></a>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<?php
			if (count($_SESSION["trainee"]) != 0)
			{
				if (isset($_POST["btnSave"]))
				{
					$query = "INSERT INTO trainee_course VALUES";
					for ($i = 0; $i < count($array) ; $i++)
					{
						$query .= " ('".$array[$i]."','".$courseID."'),";			
					}
					$query = chop($query,",");
					$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
					if ($result)
					{	
						unset($_SESSION["trainee"]);
						?>
							<script>
								alert("Successfully save data to the system");
								location.assign('http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>');
							</script>
						<?php
					}
				}
				else
				{
					if (isset($_POST["btnCancel"]))
					{
						unset($_SESSION["trainee"]);
						?>
							<script>
								location.assign('http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>');
							</script>
						<?php
					}
				}
			}
			else
			{
				?>
					<script>
						alert("No data found");
						location.assign('http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>');

					</script>
				<?php	
			}
		?>
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