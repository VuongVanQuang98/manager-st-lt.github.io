<?php
	include("db.php");
	require("authTrainerPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training || Course detail</title>
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
			<a class="navbar-brand" href="#">Course detail</a>
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
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<form action="" method="POST" name="frmAssign">
					<table align="center">
						<tr align="center">
							<th class="h3" colspan="2">Course detail</th>
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
								<p><textarea rows="3" cols="20" name="txtCourseContent" id="" class="form-control" placeholder="<?=$row['courseContent']?>"></textarea></p>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="Update" name="btnUpdate" class="btn btn-primary">
								<a href="../trainerpage.php"><input type="button" value="Back to previous page" name="btnBack" class="btn btn-primary"></a>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<form action="" method="POST" name="traineeList">
					<table border="1" class="table-dark" align="center" width="80%">
						<thead>
							<tr align="center">
								<th colspan="3" class="h3">Student list in course <?=$courseID?></th>
							</tr>
							<tr align="center">
								<th>Student ID</th>
								<th>Student name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$traineeList = "SELECT * FROM trainee INNER JOIN trainee_course ON trainee.`traineeID` = trainee_course.`traineeID` AND trainee_course.`courseID` = '".$courseID."'";
								$result = mysqli_query($connection, $traineeList) or die(mysqli_error($connection));
								if (mysqli_num_rows($result) == 0)
								{
									?>
										<tr align="center">
											<td colspan="3">There are no trainee in this course</td>
										</tr>
									<?php
								}
								else
								{
									while ($tList = mysqli_fetch_assoc($result))
									{
										?>
											<tr align="center">
												<td><?=$tList["traineeID"];?></td>
												<td><?=$tList["traineeName"];?></td>
												<td><a href="removeTraineeFromCourse.php?traineeID=<?=$tList['traineeID'];?>&courseID=<?=$courseID;?>" onclick="return confirm('Do you want to delete student with ID: <?=$tList["traineeID"]?>')">Remove</a></td>
											</tr>
										<?php
									}
								}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<?php
			if (isset($_POST["btnUpdate"]))
			{
				if ($_POST["txtCourseContent"] != null)
				{
					$newContent = $_REQUEST["txtCourseContent"];
					$updateQuery = "UPDATE course SET courseContent = '".$newContent."' WHERE courseID = '".$courseID."'";
					$result = mysqli_query($connection, $updateQuery) or die(mysqli_error($connection));
					if ($result)
					{
						?>
							<script>alert("Successfully update");
							location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID;?>");
							</script>
						<?php
					}
				}
				else
				{
					?>
						<script>
							alert("No new content updated");
							location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID;?>");
						</script>
					<?php
				}
			}
		?>
		<form method="POST" name="frmSearch">
			<div class="card-header">
				<span class="h5">Search</span>
			</div>
			<div class="card-body">
				<div class="input-group mb-3">
					<input type="text" name="txtSearch" class="form-control" placeholder="Enter trainee name...">
				 		<div class="input-group-append">
				    		<button type="submit" name="btnSearch" class="btn btn-dark">Search</button>
						</div>
					</div>
		</form>
		<table class="table-dark" border="1" width="50%" align="center">
			<thead>
				<tr align="center">
					<th class="h3" colspan="3">List of trainee not in course: <?=$courseID;?></th>
				</tr>
				<tr>
					<th>Trainee ID</th>
					<th>Trainee Name</th>
					<th>Assign to course</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if (isset($_POST["btnSearch"]))
				{
					$search = $_REQUEST["txtSearch"];
					if ($search != null)
					{
						$searchQuery = "SELECT * FROM trainee WHERE traineeName LIKE '%$search%' AND traineeID NOT IN (SELECT traineeID FROM trainee_course WHERE courseID = '".$courseID."')";
						$searchResult = mysqli_query($connection, $searchQuery) or die(mysqli_error($connection));
						$searchData = mysqli_num_rows($searchResult);
						if ($searchData == 0)
						{
							?>
								<script>
									alert("No data found");
									location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID;?>");
								</script>
							<?php
						}
						else
						{
							while ($searchRow = mysqli_fetch_assoc($searchResult))
							{
								?>
									<tr>
										<td><?=$searchRow["traineeID"];?></td>
										<td><?=$searchRow["traineeName"];?></td>
										<td><a href="http://localhost/ASM/function/updateTraineeCourse.php?courseID=<?=$courseID;?>&traineeID=<?=$searchRow["traineeID"];?>">Assign trainee to course <?=$courseID?></a></td>
									</tr>
								<?php
							}
						}
					}
					else
					{
						?>
							<script>alert("You must type something to search;")</script>
						<?php	
					}
				}
				else
				{
					$defaultQuery = "SELECT * FROM trainee WHERE traineeID NOT IN (SELECT traineeID FROM trainee_course WHERE courseID = '".$courseID."')";
					$defaultData = mysqli_query($connection, $defaultQuery) or die(mysqli_error($connection));
					while ($defaultRow = mysqli_fetch_assoc($defaultData))
					{
						$bool = true;
						if (isset($_SESSION["trainee"]))
						{
							for ($i = 0; $i < count($_SESSION["trainee"]) ; $i++)
							{
								if ($defaultRow["traineeID"] == $_SESSION["trainee"][$i])
								{
									$bool = false;
									break;
								}	
							}
						}
						if ($bool == true)
						{
							?>
								<tr>
									<td><?=$defaultRow["traineeID"];?></td>
									<td><?=$defaultRow["traineeName"];?></td>
									<td><a href="http://localhost/ASM/function/updateTraineeCourse.php?courseID=<?=$courseID;?>&traineeID=<?=$defaultRow["traineeID"];?>">Assign trainee to course <?=$courseID?></a></td>
								</tr>
							<?php
						}
					}		
				}	
			?>
			</tbody>
		</table>
		<br>
		<div align="center">
			<form action="viewAssignTable.php?courseID=<?=$courseID?>" method="POST" name="frmViewResult">
				<input type="submit" value="View result" class="btn btn-primary" name="btnView">
			</form>
		</div>
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