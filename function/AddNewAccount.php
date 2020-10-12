<?php
	include ('db.php');
	require ("authAdminPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT training || Add new account</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 150px;
		}
	</style>
</head>
<body>
	<?php
		$table = $_REQUEST["choose"];
		if (!isset($_SESSION["userID"]))
		{
			?>
				<script>
					alert("You must login first.");
					location.assign('http://localhost/ASM/index.php');
				</script>
			<?php
		}
	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Add new account</a>
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
		      <li class="nav-item">
		        	<a class="nav-link" href="#"><?=$_SESSION["userID"];?></a>
		    	</li>
		    	<li>
			    	<a class="nav-link" href="logout.php" onclick="return confirm('Do you want to logout?')">Logout</a>
			    </li>
		    </ul>
		  </div>
		</div>
	</nav>
	<main>
		<form action="" method="POST" name="frmAddNewAccount">
			<table border="1" align="center">
				<tr>
					<td>
						<table>
							<thead align="center">
								<tr>
									<th colspan="2">
										<h3>Add new <?=$table?> account</h3>
									</th>
								</tr>
							</thead>
							<tbody align="center">
								<tr>
									<td>User ID:</td>
									<td>
										<?php
											if (isset($_REQUEST["txtID"]) && $_REQUEST["txtID"] != null)
											{
												$ID = $_REQUEST["txtID"];
												?>
													<input type="text" name="txtID" class="form-control" placeholder="<?=$ID;?>" required="true" size="30" readonly="true" value="<?=$ID;?>">
												<?php
											}
											else
											{
												?>
													<input type="text" name="txtID" class="form-control" placeholder="Enter new ID" required="true" size="30">
												<?php
											}
										?>
										
									</td>
									<td>
										<input type="submit" name="btnChecker" value="Check">
									</td>
								</tr>
								<tr>
									<td>Name:</td>
									<td><input type="text" name="txtName" class="form-control" placeholder="Enter new name"></td>
								</tr>
								<tr>
									<td>Address:</td>
									<td><input type="text" name="txtAddress" class="form-control" placeholder="Enter new address" size="30"></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="txtPassword" class="form-control" placeholder="Enter new password" size="30"></td>
								</tr>
								<tr align="center">
									<td colspan="3">
										<hr>
										<input type="submit" name="btnAdd" class="btn btn-primary" name="Submit">
										<input type="reset" name="btnReset" class="btn btn-primary" value="Cancel">
										<a href="../administratorpage.php?choose=<?=$table?>"><input type="button" name="btnBack" class="btn btn-primary" value="Back"></a>
									</td>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</form>
		<?php
			if (isset($_POST["btnChecker"]) && isset($_POST["txtID"]))
			{
				$txtID = $_REQUEST["txtID"];
				?>
					<script>
						location.assign("checker.php?txtID=<?=$txtID?>&choose=<?=$table?>");
					</script>
				<?php
			}
		?>
		<?php
			if (isset($_REQUEST["btnAdd"]))
			{
				$query = "INSERT INTO ".$table." VALUES ('".$newID."','".$newName."','".$newAddress."','".$newPassword."')";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
				if ($result)
				{
					?>
						<script>
							alert("Successfully add new account");
							location.assign("http://localhost/ASM/function/AddNewAccount.php");
						</script>
					<?php
				}
				else
				{
					?>
						<script>
							alert("Cannot add new account");
							location.assign("http://localhost/ASM/function/AddNewAccount.php");
						</script>
					<?php
				}
			}
		?>
	</main>
	<footer class=" bg-dark page-footer font-small blue pt-4 fixed-bottom">

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