<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page();?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php

	if(!$current_subject)
	{
		//If the subject ID was missing or invalid or 
		// if subject couldn't be found in the database
		redirect_to("manage_content.php");
	}
?>
<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<?php

if(isset($_POST["submit"]))
{
	
	
	//validations
	$required_fields=array("menu_name","position","visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths=array("menu_name"=>30);
	validate_max_lengths($fields_with_max_lengths);
	
	if(empty($errors))
	{
		//Perform update only if there are no errors
		$id=$current_subject["id"];
		$menu_name=mysql_prep($_POST["menu_name"]);
		$position=$_POST["position"];
		$visible=$_POST["visible"];
	
		$query="UPDATE subjects SET ";
		$query.="menu_name= '{$menu_name}', ";
		$query.="position= {$position}, ";
		$query.="visible= {$visible} ";
		$query.="WHERE id={$id} ";
		$query.="LIMIT 1";
		$result=mysqli_query($connection,$query); //$result is a special data type called as resource which is a collection of database rows
	
		if($result && mysqli_affected_rows($connection)>=0)
		{
			//Success
			$_SESSION["message"]="Subject updated";
			redirect_to("manage_content.php"); 
		}
		else
		{
			$message="Unable to edit subject";   // We don't use session here as we are not redirecting to a different page but could just echo the message here itself
			
		}
	}
}//end:if(isset($_POST["submit"]))
else
{
	//Redisplay the form.
	
}


?>


<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>                                                                         
	</div>
	
	<div id="page">
		<?php if(!empty($message)){echo "<div class=\"message\">".htmlentities($message)."</div>";} ?>
		<?php echo form_errors($errors); ?>
		<h2>Edit Subject:<?php echo " ". $current_subject["menu_name"];?></h2>
		
		<form action="edit_subject.php?subject=<?php echo " ". urlencode($current_subject["id"]);?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]);?>" />
			</p>
			<p>Position:
				<select name="position">
				<?php
					$subject_set=find_all_subjects(false);  // Passing argument false to inform function that this is an admin call and not a public one
															// to make even the not visible subjects visible
					$subject_count=mysqli_num_rows($subject_set);
					for($count=1; $count<=$subject_count; $count++) //count<=subject_count as we are not adding any new subject but editing the already present ones
					{
						// to display the position of the subject to be edited when the page loads
						echo "<option value=\"{$count}\"";
						if($current_subject["position"]==$count)
						{
							echo "selected";        // html tag option that specifies an option should be preloaded when the page loads
						}
						
						echo ">{$count}</option>";
					}
				
				
				?>
					
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" <?php if($current_subject["visible"]==0){echo "checked";}?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if($current_subject["visible"]==1){echo "checked";}?> /> Yes
			</p>
			<input type="submit" name="submit" value="Edit Subject" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>" onclick="return confirm('Are you sure ?');">Delete Subject</a> <!-- Java script for a pop up-->
		
	</div>
</div>

	
<?php include("../includes/layouts/footer.php"); ?>