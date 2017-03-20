<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context="public"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(true);?>

<div id="main">
	<div id="navigation">
		
		<?php echo public_navigation($current_subject,$current_page); ?> 
		
	</div>
	
	
	<div id="page">
		<?php echo message(); ?>
		<p></p>
		<ul>
			 
		
			<?php
			
			if($current_page)
			{
			?> <h2><?php echo $current_page["menu_name"]; ?></h2></br>
			<?php
				echo nl2br(htmlentities($current_page["content"]));//nl2br new line to break tag. When writing content newline charecters are considered as break tags;
			}
			else
			{
			?>
			<p><?php echo "Welcome"; ?></p>
			<?php
			}
			?>
				
			
			 
		</ul>
	</div>
</div>

	
<?php include("../includes/layouts/footer.php"); ?>