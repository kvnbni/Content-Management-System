<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page();?>
<?php
if(isset($_POST["submit"]))
{
	//Process the form
	$subject_id=$_GET["subject"];
	$menu_name=mysql_prep($_POST["menu_name"]);
	$position=$_POST["position"];
	$visible=$_POST["visible"];
	$content=mysql_prep($_POST["content"]);
	
	//validations
	$required_fields=array("menu_name","position","visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths=array("menu_name"=>30);
	validate_max_lengths($fields_with_max_lengths);
	
	if(!empty($errors))
	{
		$_SESSION["errors"]= $errors;
		redirect_to("new_page.php?subject=$subject_id");
	}
	
	$query="INSERT INTO pages ";
	$query.="(subject_id, menu_name, position, visible, content) ";
	$query.="VALUES ";
	$query.="({$subject_id},'{$menu_name}',{$position},{$visible},'{$content}')"; 
	$result=mysqli_query($connection,$query); 
	
	if($result)
	{
		//Success
		$_SESSION["message"]="Page created";
		redirect_to("manage_content.php"); 
		
	}
	else
	{
		$_SESSION["message"]="Page creation failed";
		redirect_to("new_page.php");
	}
}
else
{
	// Possible GET request
	redirect_to("manage_content.php");
}

?>