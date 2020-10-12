<?php
	include ('db.php');
	session_start();
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Assign student to course</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 58px;
		}
	</style>
</head>
<body>
	<?php
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
	<main>
		<?php
			$ID = $_REQUEST["userID"];
			$table = $_REQUEST["choose"];
			$query = "SELECT * FROM ".$table." WHERE ".$table."ID = '".$ID."'";
			$result = mysqli_query($connection, $query) or die(mysqli_error());
			$row = mysqli_fetch_assoc($result);
		?>
		<div class="content">
			<form action="" method="POST" name="frmUpdate">
				<table align="center">
					<thead align="center">
						<tr>
							<th class="h5" colspan="2">Update account</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>User ID:</td>
							<td>
								<input type="text" name="txtID" value="<?=$ID?>" readonly="true">
							</td>
						</tr>
						<tr>
							<td>Name:</td>
							<td>
								<input type="text" name="txtName" value="<?=$row[$table.'Name']?>" placeholder="Enter new Name" required="true">
							</td>
						</tr>
						<tr>
							<td>Address:</td>
							<td>
								<input type="text" name="txtAddress" value="<?=$row[$table.'Address']?>" placeholder="Enter new Address" required="true">
							</td>
						</tr>
						<tr>
							<td>Password:</td>
							<td>
								<input type="password" name="txtPassword" value="<?=$row[$table.'Password']?>" placeholder="Enter new Password" required="true">
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="Update" name="btnUpdate" class="btn btn-primary" onclick="return confirm('Do you want to update?')">
								<input type="reset" value="Cancel" name="btnReset" class="btn btn-primary">
								<a href="../administratorpage.php"><input type="button" name="btnBack" class="btn btn-primary" value="Back"></a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php
				if (isset($_POST["btnUpdate"]))
				{
					$newName = $_REQUEST["txtName"];
					$newAddress = $_REQUEST["txtAddress"];
					$newPassword = $_REQUEST["txtPassword"];
					$update = "UPDATE ".$table." SET ".$table."Name = '".$newName."',".$table."Address = '".$newAddress."',".$table."Password = '".$newPassword."' WHERE ".$table."ID = '".$ID."'";
					$updateResult = mysqli_query($connection, $update) or die(mysqli_error($connection));
					if ($update)
					{
						?>
							<script>
								alert("Successfully update.");
								location.assign("http://localhost/ASM/administratorpage.php?choose=<?=$table?>");
							</script>
						<?php	
					}
				}
			?>
		</div>
	</main>
	<br>
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