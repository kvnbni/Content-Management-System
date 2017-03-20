<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_subject=find_subject_by_id($_GET["subject"],false);  //?subject=id
	if(!$current_subject)
	{
		// No such subject exists
		redirect_to("manage_content.php");
	}
	
	$page_set=find_pages_for_subject($current_subject["id"]);
	if(mysqli_num_rows($page_set)>0)
	{
		$_SESSION["message"]="Can't delete subject with pages";
		redirect_to("manage_content.php?subject={$current_subject["id"]}");
	}
	$id=$current_subject["id"];
	$query="DELETE FROM subjects WHERE id={$id} LIMIT 1";
	$result=mysqli_query($connection,$query);
	if($result && mysqli_affected_rows($connection)==1)
	{
		$_SESSION["message"]="Subject deletion successful";
		redirect_to("manage_content.php");
	}
	else
	{
		$_SESSION["message"]="Subject deletion failed";
		redirect_to("manage_content.php?subject={$id}");
	}

?>