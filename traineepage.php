<?php
	include ('function/db.php');
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Trainning || Trainee page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css">
		main.content{
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">FPT Training - Trainee page</a>
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
					<div class="card mt-4">
						<div class="card-header">
							<span class="h5">Search</span>
						</div>
						<div class="card-body">
							<div class="input-group mb-3">
							  <input type="text" class="form-control" placeholder="searh for...">
							  <div class="input-group-append">
							    <span class="input-group-text">Search</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<span class="h5">Categories</span>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6 col-md-6 col-xl-6 col-lg-6">
									<ul class="list-unstyled">
										<li>
											<a href="#">PHP</a>
										</li>
										<li>
											<a href="#">Java</a>
										</li>
										<li>
											<a href="#">.Net</a>
										</li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-6 col-xl-6 col-lg-6">
									<ul class="list-unstyled">
										<li>
											<a href="#">HTML</a>
										</li>
										<li>
											<a href="#">CSS</a>
										</li>
										<li>
											<a href="#">Javascript</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
					<!-- cot ben trai -->
					<nav aria-label="breadcrumb" class="mt-4">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="#">Home</a></li>
					    <li class="breadcrumb-item"><a href="#">Library</a></li>
					    <li class="breadcrumb-item active" aria-current="page">Data</li>
					  </ol>
					</nav>
					<h1 class="h1 mt-3"> <strong>Course list</strong></h1>
				<div style="overflow: scroll; height: 300px;">
				<table class="table table-dark" border="1">
					  <thead>
						<tr>
							<th>Course ID</th>
							<th>Topic ID</th>
							<th>Category Type</th>
							<th>Trainer ID</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Location</th>
							<th>Choose a course</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = "SELECT * FROM `course`";
							$result = mysqli_query($connection, $query) or die(mysqli_error());
							if (mysqli_num_rows($result) == null)
							{
								?>
								<script>alert('No data found')</script>
								<?php
							}
							else
							{
								while ($row = mysqli_fetch_assoc($result))
								{?>
									<tr>
										<td align = "center"><?php echo $row["courseID"]; ?></td>
										<td align = "center"><?php echo $row["topicID"]; ?></td>
										<td align = "center"><?php echo $row["categoryType"]; ?></td>
										<td align = "center"><?php echo $row["trainerID"]; ?></td>
										<td align = "center"><?php echo $row["courseStartDate"]; ?></td>
										<td align = "center"><?php echo $row["courseEndDate"]; ?></td>
										<td align = "center"><?php echo $row["courseLocation"]; ?></td>
										<td align = "center">
											<a href = "function/traineeViewCourse.php?courseID=<?=$row['courseID'];?>">
												Choose
											</a>
										</td>
									</tr>
									<?php
								}
							}
						?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
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