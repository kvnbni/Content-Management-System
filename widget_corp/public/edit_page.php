<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page();?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php

	if(!$current_page)
	{
		
		redirect_to("manage_content.php");
	}
?>
<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<?php

if(isset($_POST["submit"]))
{
	$id=$current_page["id"];
	$menu_name=mysql_prep($_POST["menu_name"]);
	$position=(int)$_POST["position"];
	$visible=(int)$_POST["visible"];
	$content=mysql_prep($_POST["content"]);
	
	//validations
	$required_fields=array("menu_name","position","visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths=array("menu_name"=>30);
	validate_max_lengths($fields_with_max_lengths);
	
	if(empty($errors))
	{
		//Perform update only if there are no errors
		
	
		$query="UPDATE pages SET ";
		$query.="menu_name= '{$menu_name}', ";
		$query.="position= {$position}, ";
		$query.="visible= {$visible}, ";
		$query.="content= '{$content}' ";
		$query.="WHERE id= {$id} ";
		$query.="LIMIT 1";
		$result=mysqli_query($connection,$query); 
	
		if($result && mysqli_affected_rows($connection)>=0)
		{
			//Success
			$_SESSION["message"]="Page updated";
			redirect_to("manage_content.php?page={$id}"); 
		}
		else
		{
			$message=" Unable to edit page";   // We don't use session here as we are not redirecting to a different page but could just echo the message here itself
			
		}
	}
}//end:if(isset($_POST["submit"]))
else
{
	//redirect_to("manage_content.php");
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
		<h2>Edit Page:<?php echo " ". $current_page["menu_name"];?></h2>
		
		<form action="edit_page.php?page=<?php echo " ". urlencode($current_page["id"]);?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]);?>" />
			</p>
			<p>Position:
				<select name="position">
				<?php
					$id=$current_page["subject_id"];
					$page_set=find_pages_for_subject($id);
					$page_count=mysqli_num_rows($page_set);
					for($count=1; $count<=$page_count; $count++)
					{
						echo "<option value=\"{$count}\"";
						if($current_page["position"]==$count)
						{
							echo "selected";        // html tag option that specifies an option should be preloaded when the page loads
						}
						
						echo ">{$count}</option>";
					}
				?>
					
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" <?php if($current_page["visible"]==0){echo "checked";}?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if($current_page["visible"]==1){echo "checked";}?> /> Yes
			</p>
			Content:</br>
				<textarea name="content" rows="20" cols="80" ><?php echo htmlentities($current_page["content"])?></textarea>
			&nbsp;
			&nbsp;
			</br><input type="submit" name="submit" value="Edit Page" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
		&nbsp;
		&nbsp;
		
		
	</div>
</div>

	
<?php include("../includes/layouts/footer.php"); ?>