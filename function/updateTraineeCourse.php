<?php
	include ("db.php");
	require ("authTrainerPage.php");
	$traineeID = $_REQUEST["traineeID"];
	$courseID = $_REQUEST["courseID"];
	$checker = "SELECT * FROM `trainee_course` WHERE traineeID = '".$traineeID."' AND courseID = '".$courseID."'";
	$checkerStatus = mysqli_query($connection, $checker) or die(mysqli_error($connection));
	if (mysqli_num_rows($checkerStatus) != 0)
	{
		?>
			<script>
				alert("This trainee is already in this course");
				location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>");
			</script>
		<?php		
	}
	else
	{	
		$bool = true;
		if (!isset($_SESSION["trainee"]))
		{
			$_SESSION["trainee"] = array();
		}
		for ($i = 0; $i < count($_SESSION["trainee"]) ; $i++)
		{
			if ($_SESSION["trainee"][$i] == $traineeID)
			{
				?>
					<script>
						alert("This student already assigned to this course");
						location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>");
					</script>
				<?php
				$bool = false;
				break;
			}
		}
		if ($bool == true)
		{
			$_SESSION["trainee"][] = $traineeID;
			?>
			<script>
				alert("Successfully assign");
				location.assign("http://localhost/ASM/function/trainerAssign.php?courseID=<?=$courseID?>");
			</script>
			<?php
		}
	}
?>