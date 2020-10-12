<?php
	include ('db.php');
	require ("authAdminPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training || Add new course</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 75px;
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Add new course</a>
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
			<table border="1" align="center" style="overflow: scroll; width: 200px;">
				<td>
					<table align="center">
						<thead align="center">
							<tr>
								<th colspan="2">
									<span class="h5">Add new course</span>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Course ID:</td>
								<td>
									<input type="text" name = "txtCourseID" class="form-control" placeholder="Enter new course ID" required="true" size="30">
								</td>
								<td>
									<input type="button" name="btnCheckID" value="Check">
								</td>
							</tr>
							<tr>
								<td>Topic:</td>
								<td>
									<select name="selectTopic" id="topic" style="width: 260px;">
										<?php
											$topicQuery = "SELECT topicID, topicName FROM topic";
											$topicResult = mysqli_query($connection, $topicQuery) or die(mysqli_error());
											while ($topicRow = mysqli_fetch_assoc($topicResult))
											{
												?>
													<option value="<?=$topicRow['topicID'];?>"><?=$topicRow["topicName"];?></option>
												<?php
											}
										?>
									</select>
								</td>
								<td><input type="button" name = "btnAddTopic" value = "  Add "></td>
							</tr>
							<tr>
								<td>Category type:</td>
								<td>
									<select name="selectCategory" id="category" style="width: 260px;">
										<?php
											$categoryQuery = "SELECT categoryType FROM category";
											$categoryResult = mysqli_query($connection, $categoryQuery) or die(mysqli_error());
											while ($categoryRow = mysqli_fetch_assoc($categoryResult))
											{
												?>
													<option value="<?=$categoryRow['categoryType'];?>"><?=$categoryRow['categoryType'];?></option>
												<?php
											}
										?>
									</select>
								</td>
								<td>
									<input type="button" name = "btnAddCategory" value = "  Add ">
								</td>
							</tr>
							<tr>
								<td>Trainer:</td>
								<td>
									<select name="selectTrainer" id="trainer" style="width: 260px;">
										<?php
											$trainerQuery = "SELECT trainerID, trainerName FROM trainer";
											$trainerResult = mysqli_query($connection, $trainerQuery) or die(mysqli_error());
											while ($trainerRow = mysqli_fetch_assoc($trainerResult))
											{
												?>
													<option value="<?=$trainerRow['trainerID'];?>"><?=$trainerRow['trainerName'];?></option>
												<?php
											}
										?>
									</select>
								</td>
								<td>
									<input type="button" name = "btnAddTrainer" value = "  Add ">
								</td>
							</tr>
							<tr>
								<td>Start date:</td>
								<td><input type="date" name="txtStartDate" class="form-control" required="true"></td>
							</tr>
							<tr>
								<td>End date:</td>
								<td><input type="date" name="txtEndDate" class="form-control" required="true"></td>
							</tr>
							<tr>
								<td>Location:</td>
								<td>
									<textarea name="txtLocation" required="true" class="form-control" maxlength="255" placeholder="Enter new course location"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="center">
									<input type="submit" value="Add new" name="btnSubmit" class="btn btn-primary">
									<a href="../administratorpage.php?choose=courseManage"><input type="button" name = "btnBack" value="Back" class="btn btn-primary"></a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</table>
		</form>
		<?php
			if (isset($_POST["btnSubmit"]))
			{
				$courseID = $_REQUEST["txtCourseID"];
				$topicID = $_REQUEST["selectTopic"];
				$categoryType = $_REQUEST["selectCategory"];
				$trainerID = $_REQUEST["selectTrainer"];
				$courseStartDate = $_REQUEST["txtStartDate"];
				$courseEndDate = $_REQUEST["txtEndDate"];
				$courseLocation = $_REQUEST["txtLocation"];
				$insert = "INSERT INTO course VALUES('".$courseID."','".$topicID."','".$categoryType."','".$trainerID."','".$courseStartDate."','".$courseEndDate."','".$courseLocation."')";
				$result = mysqli_query($connection, $insert) or die(mysqli_error($connection));
				if ($result)
				{
					?>
						<script>
							alert("Successfully add new course.");
							location.assign("http://localhost/ASM/function/AddCourse.php");
						</script>
					<?php
				}
				else
				{
					?>
						<script>
							alert("Cannot add new course.");
							location.assign("http://localhost/ASM/function/AddCourse.php");
						</script>
					<?php
				}
			}
		?>
	</main>
	<br>
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