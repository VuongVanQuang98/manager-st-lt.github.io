<?php
	session_start();
	if (session_destroy())
	{
		?>
		<script>location.assign('http://localhost/ASM/index.php');</script>
		<?php
	}
?>