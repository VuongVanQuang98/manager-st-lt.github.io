<?php
	include ("db.php");
	session_start();
	if (isset($_SESSION["userID"]))
	{
		$checkRole = $_SESSION["userID"];
		$checkRoleQuery = "SELECT * FROM administrator WHERE administratorID = '".$checkRole."'";
		$checkRoleResult = mysqli_query($connection, $checkRoleQuery) or die(mysqli_error($connection));
		if (mysqli_num_rows($checkRoleResult) == 0)
		{
			$checkRoleQuery1 = "SELECT * FROM trainer WHERE trainerID = '".$checkRole."'";
			$checkRoleResult1 = mysqli_query($connection, $checkRoleQuery1) or die(mysqli_error($connection));
			if (mysqli_num_rows($checkRoleResult1) != 0)
			{
				?>
				<script>
					alert("You do not have permission to view this site");
					location.assign("http://localhost/ASM/trainerpage.php");
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("You do not have permission to view this site");
					location.assign("http://localhost/ASM/traineepage.php");
				</script>
				<?php
			}
		}
	}
?>