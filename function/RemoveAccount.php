<?php
	include ("db.php");
	require ("authAdminPage.php");
		if (!isset($_SESSION["userID"]))
		{
			?>
				<script>
					alert("You must login first.");
					location.assign('http://localhost/ASM/index.php');
				</script>
			<?php
		}
	$userID = $_REQUEST["userID"];
	$table = $_REQUEST["choose"];
	$query = "DELETE FROM ".$table." WHERE ".$table."ID = '".$userID."'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	if ($result)
	{
		?>
			<script>
				alert("Successfully delete");
				location.assign("../administratorpage.php?choose=<?=$table?>");
			</script>
		<?php
	}
	else
	{
		?>
			<script>
				alert("Cannot delete this account");
				location.assign("../administratorpage.php?choose=<?=$table?>");
			</script>
		<?php
	}
?>