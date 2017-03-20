<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	if(!isset($_GET["page"]))
	{
		redirect_to("manage_content.php");
	}
	$current_page=find_page_by_id($_GET["page"],false);
	if(!$current_page)
	{
		// No such subject exists
		redirect_to("manage_content.php");
	}
	
	
	$id=$current_page["id"];
	$query="DELETE FROM pages WHERE id={$id} LIMIT 1";
	$result=mysqli_query($connection,$query);
	if($result && mysqli_affected_rows($connection)==1)
	{
		$_SESSION["message"]="Subject deletion successful";
		redirect_to("manage_content.php");
	}
	else
	{
		$_SESSION["message"]="Subject deletion failed";
		redirect_to("manage_content.php?page={$id}");
	}

?>