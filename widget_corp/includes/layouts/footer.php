<div id="footer">Copyright <?php echo date("Y"); ?>, Widget Corp</div>
	</body>
</html>
<?php
//Close the connection
	if(isset($connection))
	{
		mysqli_close($connection);
	}
	
?>