<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page();?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>                                                                         
	</div>
	
	<div id="page">
		<?php echo message(); ?>
		<?php $errors=errors(); ?>
		<div class="error"><?php echo form_errors($errors); ?></div>
		<h2>Create a new page<?php echo " in ".$current_subject["menu_name"];?></h2>
		
		<form action="create_page.php?subject=<?php echo urlencode($current_subject["id"]);?>" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="" />
			</p>
			<p>Position:
				<select name="position">
				<?php
					$page_set=find_pages_for_subject($current_subject["id"]);
					$page_count=mysqli_num_rows($page_set);
					for($count=1; $count<=$page_count+1; $count++)
					{
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>	
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" /> No
				&nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			Content:</br>
				<textarea name="content" rows="10" cols="50" >Write your content here</textarea>
			&nbsp;
			&nbsp;
			</br><input type="submit" name="submit" value="Create Page" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
		
	</div>
</div>

<!-- Creating the form --!>



	
<?php include("../includes/layouts/footer.php"); ?>