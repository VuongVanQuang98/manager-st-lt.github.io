<?php
	require('db.php');
	include ("authAdminPage.php");
		if (!isset($_SESSION["userID"]))
		{
			?>
				<script>
					alert("You must login first.");
					location.assign('http://localhost/ASM/index.php');
				</script>
			<?php
		}
	$courseID = $_REQUEST['courseID'];
	$traineeID = $_REQUEST['traineeID'];
	$query = "DELETE FROM `trainee_course` WHERE traineeID = '".$traineeID."'";
	$result = mysqli_query($connection, $query) or die(mysqli_error());
	header("Location: http://localhost/ASM/function/trainerAssign.php?courseID=".$courseID);
?>