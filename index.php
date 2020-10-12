<?php
	include("function/db.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 150px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">FPT Training - Login</a>
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
			    			<a class="nav-link" href="function/logout.php" onclick="return confirm('Do you want to logout?')">Logout</a>
			    		</li>
			    		<?php
			    	}
		    	?>
		  </div>
		</div>
	</nav>
	<main>
		<form action="" method="POST" name="frmLogin">
			<table border="1 solid" align="center">
				<tr>
					<td>
						<table align="center" cellpadding="5">
							<thead align="center">
								<tr>
									<th colspan="2">
										LOGIN
									</th>
								</tr>
							</thead>
							<tbody align="center">
								<tr>
									<td>User ID:</td>
									<td><input type="text" name="txtID" class="form-control" placeholder="Enter your ID..." required="true" size="30"></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="txtPassword" class="form-control" placeholder="Enter your password" required="true" size="30"></td>
								</tr>
								<tr>
									<td>Role:</td>
									<td>
										<select name="roleSelect" id="roleID" style="width: 273px;" class="form-control">
											<option value="administrator">Admin</option>
											<option value="trainer">Trainer</option>
											<option value="trainee">Trainee</option>
										</select>
									</td>
								</tr>
								<tr align="center">
									<td colspan="2">
										<hr>
									</td>
								</tr>
								<tr align="center">
									<?php
										if (isset($_SESSION["userID"]))
										{
											?>
											<td colspan="2"><button type="submit" name="btnLogin" class="btn btn-primary" disabled="true">Login</button></td>
											<?php
										}
										else
										{
											?>
											<td colspan="2"><button type="submit" name="btnLogin" class="btn btn-primary">Login</button></td>
											<?php
										}
									?>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</form>	
	</main>
	<footer class="bg-dark page-footer font-small blue pt-4 fixed-bottom">
	<?php
		if (isset($_POST["btnLogin"]))
		{
			$userID = stripslashes($_REQUEST["txtID"]);
			$userID = mysqli_real_escape_string($connection, $userID);
			$password = stripslashes($_REQUEST["txtPassword"]);
			$password = mysqli_real_escape_string($connection, $password);
			$role = $_REQUEST["roleSelect"];
			if ($role == null)
			{
				?>
					<script>
						alert("Login failed");
						location.assign("http://localhost/ASM/index.php");
					</script>
				<?php
			}
			else
			{
				$query = "SELECT * FROM ".$role." WHERE ".$role."ID = '".$userID."' AND ".$role."Password = '".$password."'";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
				$account = mysqli_fetch_assoc($result);
				$row = mysqli_num_rows($result);
				if ($row == 0)
				{
					?>
						<script>
							alert("Login failed");
							location.assign("http://localhost/ASM/index.php");
						</script>
					<?php
				}
				else
				{
					$_SESSION["userID"] = $userID;
					?>
						<script>
							alert("User: <?=$userID;?> has logged in.");
							location.assign("http://localhost/ASM/<?=$role?>page.php");
						</script>
					<?php
				}
			}
		}
	?>
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