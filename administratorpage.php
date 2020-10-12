<?php
	include ('function/db.php');
	require ("function/authAdminPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training || Administrator page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css">
		body{
			margin-top: 58px;
		}
	</style>
</head>
<body>
	<?php
		if ($_REQUEST["choose"] == null)
		{
			?>
			<script>
				location.assign("http://localhost/ASM/administratorpage.php?choose=trainee");
			</script>
			<?php
		}
	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">FPT Training - Administrator page</a>
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
		    		<a href="trainerpage.php" class="nav-link">Go to trainer page</a>
		    	</li>
		    	<li>
			    	<a class="nav-link" href="function/logout.php" onclick="return confirm('Do you want to logout?')">Logout</a>
			    </li>
		    </ul>
		  </div>
		</div>
	</nav>
	<main class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
					<!-- cot ben phai -->
					<div class="card mt-3">
						<div class="card-header">
							<span class="h5">Categories</span>
						</div>
						<div class="row">
							<div class="card-body">
								<div class="col">
									<form action="" method="POST" name = "chooseManage">
										<ul class="list-group">
											<li class="list-group-item"><a href="administratorpage.php">Account Management</a>
												<ul class="submenu" style="position: relative; top: 0;">
													<li class="list-group-item"><a href="administratorpage.php?choose=trainer">- Trainer</a></li>
													<li class="list-group-item"><a href="administratorpage.php?choose=trainee">- Trainee</a></li>
												</ul>
											</li>
											<li class="list-group-item"><a href="administratorpage.php?choose=courseManage">Course Management</a></li>
											<li class="list-group-item"><a href="administratorpage.php?choose=catalogManage">Catalog Management</a></li>
											<li class="list-group-item"><a href="administratorpage.php?choose=topicManage">Topic Management</a></li>
										</ul>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class = "col-sm-8 col-md-8 col-lg-8 col-xl-8">
					<div class = "mt-4">
						<?php
						if (isset($_POST["btnSearch"]))
						{
							if (isset($_POST["txtSearch"]) && ($_POST["txtSearch"] != null))
							$choose = ($_REQUEST["choose"]);
							$search = ($_POST["txtSearch"]);
							?>
								<script>
									location.assign('http://localhost/ASM/function/adminSearchForm.php?choose=<?=$choose?>&name=<?=$search?>');
								</script>
							<?php
						}	
						?>
						<form method="POST" name="frmSearch">
							<div class="card-header">
									<span class="h5">Search</span>
								</div>
								<div class="card-body">
									<div class="input-group mb-3">
							  			<input type="text" name="txtSearch" class="form-control" placeholder="search for...">
							 		<div class="input-group-append">
							    		<input type="submit" value="Search" name="btnSearch" class="btn btn-dark">
									</div>
								</div>
						</form>
						<form action="">						
							<table 	class="table table-dark" border="1" style="overflow: scroll; height: 50%";>
								<?php
										if (isset($_REQUEST["choose"]))
										{
											$choice = $_REQUEST["choose"];
										}
										else
										{
											$choice = "";
										}
										switch ($choice) {
											case "courseManage":
												{
													?>
														<thead>
															<tr>
																<th>Course ID</th>
																<th>Topic ID</th>
																<th>Category Type</th>
																<th>Trainer ID</th>
																<th>Start Date</th>
																<th>End Date</th>
																<th>Location</th>
																<th>Update</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
													<?php
														$query = "SELECT * FROM course";
														$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
														while ($row = mysqli_fetch_assoc($result))
														{
															?>
																<tr>
																	<td><?=$row["courseID"];?></td>
																	<td><?=$row["topicID"];?></td>
																	<td><?=$row["categoryType"];?></td>
																	<td><?=$row["trainerID"];?></td>
																	<td><?=$row["courseStartDate"];?></td>
																	<td><?=$row["courseEndDate"];?></td>
																	<td><?=$row["courseLocation"];?></td>
																	<td><a href="">Update</a></td>
																	<td><a href="" onclick = "">Delete</a></td>
																</tr>
															<?php
														}
														?>
															<tr>
																<td colspan="9" align="center">
																	<a href="function/AddCourse.php"><input type="button" name="btnAddCourse" value="Add new"></a>
																</td>
															</tr>
														</tbody>
														<?php
													break;
												}
											case "catalogManage":
												{
													?>
														<thead>
															<tr>
																<th>ID</th>
																<th>Description</th>
																<th>Update</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
													<?php
														$query = "SELECT * FROM category";
														$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
														while ($row = mysqli_fetch_assoc($result))
														{
															?>
																<tr>
																	<td><?=$row["categoryType"];?></td>
																	<td><?=$row["categoryDescription"];?></td>
																	<td><a href="">Update</a></td>
																	<td><a href="" onclick = "">Delete</a></td>
																</tr>
															<?php
														}
														?>
															<tr>
																<td colspan="4" align="center">
																	<a href=""><input type="submit" name="btnAddCata" value="Add new"></a>
																</td>
															</tr>
														</tbody>
														<?php
													break;
												}
											case "topicManage":
												{
													?>
														<thead>
															<tr>
																<th>Topic ID</th>
																<th>Topic Name</th>
																<th>Description</th>
																<th>Update</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$query = "SELECT * FROM topic";
														$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
														while ($row = mysqli_fetch_assoc($result))
														{
															?>
																<tr>
																	<td><?=$row["topicID"];?></td>
																	<td><?=$row["topicName"];?></td>
																	<td><?=$row["topicDescription"];?></td>
																	<td><a href="">Update</a></td>
																	<td><a href="" onclick = "">Delete</a></td>
																</tr>
															<?php
														}
														?>
														<tr>
															<td colspan="5" align="center">
																<a href=""><input type="submit" name="btnAddTopic" value="Add new"></a>
															</td>
														</tr>
														</tbody>
														<?php
													break;
												}
											case "trainer":
											{
												?>
													<div>
														<thead>
															<tr align="center">
																<td colspan="6">
																	<span class="h5">Trainer</span>
																</td>
															</tr>
															<tr>
																<th>Trainer ID</th>
																<th>Trainer Name</th>
																<th>Trainer Address</th>
																<th>Password</th>
																<th>Update</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$query = "SELECT * FROM trainer";
																$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
																while ($row = mysqli_fetch_assoc($result))
																{
																	?>
																		<tr>
																			<td><?=$row["trainerID"];?></td>
																			<td><?=$row["trainerName"];?></td>
																			<td><?=$row["trainerAddress"];?></td>
																			<td><?=$row["trainerPassword"];?></td>
																			<td><a href="function/updateAccount.php?choose=trainer&userID=<?=$row['trainerID'];?>">Update</a></td>
																			<td><a href="function/RemoveAccount.php?choose=trainer&userID=<?=$row['trainerID'];?>" onclick = "return confirm('Are you certain that you want to delete?');">Delete</a></td>
																		</tr>
																	<?php
																}
																?>
																<tr align="center">
																	<td colspan="6">
																		<a href="function/AddNewAccount.php?choose=trainer"><input type="button" name="btnAddTrainer" value="Add new"></a>
																	</td>
																	</tr>
															</tbody>
														</div>
													<?php
													break;
												}
											default:
											{
												?>
													<div>
														<thead>
															<tr align="center">
																<td colspan="6">
																	<span class="h5">Trainee</span>
																</td>
															</tr>
															<tr>
																<th>Trainee ID</th>
																<th>Trainee Name</th>
																<th>Trainee Address</th>
																<th>Password</th>
																<th>Update</th>
																<th>Delete</th>
															</tr>
														</thead>
															<tbody>
															<?php
																$query = "SELECT * FROM trainee";
																$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
																while ($row = mysqli_fetch_assoc($result))
																{
																	?>
																		<tr>
																			<td><?=$row["traineeID"];?></td>
																			<td><?=$row["traineeName"];?></td>
																			<td><?=$row["traineeAddress"];?></td>
																			<td><?=$row["traineePassword"];?></td>
																			<td><a href="function/updateAccount.php?choose=trainee&userID=<?=$row['traineeID'];?>">Update</a></td>
																			<td><a href="function/RemoveAccount.php?choose=trainee&userID=<?=$row['traineeID'];?>" onclick = "return confirm('Are you certain that you want to delete?');">Delete</a></td>
																		</tr>
																	<?php
																}
																?>
																<tr align="center">
																	<td colspan="6">
																		<a href="function/AddNewAccount.php?choose=trainee"><input type="button" name="btnAddTrainer" value="Add new"></a>
																	</td>
																</tr>
															</tbody>
														</div>
															<?php
													break;
												}
										}
								?>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
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