<?php
	include ("db.php");
	require ("authAdminPage.php");
	$choose = $_REQUEST["choose"];
				if ($_REQUEST["txtID"] == null)
				{
					?>
						<script>
							alert("Chua co ID");
							location.assign("AddNewAccount.php?choose=<?=$choose?>");
						</script>
					<?php
				}
				else
				{
					$ID = $_REQUEST["txtID"];
				}
				$checker1 = "SELECT * FROM administrator WHERE administratorID = '".$ID."'";
				$result1 = mysqli_query($connection, $checker1) or die(mysqli_error($connection));
				$row1 = mysqli_num_rows($result1);
				if ($row1 != 0)
				{
					?>
						<script>
							alert("Sao ngu the nhap trung roi.");
							location.assign("AddNewAccount.php?choose=<?=$choose;?>");
						</script>
					<?php
				}
				else
				{
					$checker2 = "SELECT * FROM trainer WHERE trainerID = '".$ID."'";
					$result2 = mysqli_query($connection, $checker2) or die(mysqli_error($connection));
					$row2 = mysqli_num_rows($result2);
					if ($row2 != 0)
					{
						?>
							<script>
								alert("Sao ngu the nhap trung roi.");
								location.assign("AddNewAccount.php?choose=<?=$choose;?>");
							</script>
						<?php
					}
					else
					{
						$checker3 = "SELECT * FROM trainee WHERE traineeID = '".$ID."'";
						$result3 = mysqli_query($connection, $checker3) or die(mysqli_error($connection));
						$row3 = mysqli_num_rows($result3);
						if ($row3 != 0)
						{
							?>
								<script>
									alert("Sao ngu the nhap trung roi.");
									location.assign("AddNewAccount.php?choose=<?=$choose;?>");
								</script>
							<?php
						}
						else {
							?>
								<script>
									alert("Khon ra roi day.");
									location.assign("AddNewAccount.php?txtID=<?=$ID;?>&choose=<?=$choose;?>");
								</script>
							<?php
						}
					}
				}
		?>