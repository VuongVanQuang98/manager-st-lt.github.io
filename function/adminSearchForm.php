<?php
	include("db.php");
	require ("authAdminPage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPT Training || Search result</title>
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Search result</a>
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
		<table class="table-dark" style="overflow: scroll; height: auto;" align="center" border="1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Password</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$table = $_REQUEST["choose"];
					$name = $_REQUEST["name"];
					$search = "SELECT * FROM ".$table." WHERE ".$table."Name LIKE '%$name%'";
					$searchResult = mysqli_query($connection, $search) or die(mysqli_error($connection));
					while ($row = mysqli_fetch_assoc($searchResult))
					{
						?>
							<tr>
								<td><?=$row[$table."ID"];?></td>
								<td><?=$row[$table."Name"];?></td>
								<td><?=$row[$table."Address"];?></td>
								<td><?=$row[$table."Password"];?></td>
								<td><a href="">Update</a></td>
								<td><a href="" onclick = "">Delete</a></td>
							</tr>
						<?php
					}
				?>
			</tbody>
		</table>
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