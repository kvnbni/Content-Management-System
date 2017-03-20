<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page();?>

<div id="main">
	<div id="navigation">
		<a href="admin.php">&laquo; Main Menu</a></br></br>
		<?php echo navigation($current_subject,$current_page); ?> 
		<a href="new_subject.php">+ Add a new subject</a>
	</div>
	
	
	<div id="page">
		<?php echo message(); ?>
		<p></p>
		<ul>
			<?php 
			
			if($current_subject)
			{
			?>
				<h2>Manage subject</h2>
			<?php
				
				echo "Menu name: " .htmlentities($current_subject["menu_name"])  ."</br>" ;
			
			?>
				Position: <?php echo $current_subject["position"]; ?></br>
				Visible: <?php echo $current_subject["visible"]==1? 'yes': 'no'; ?></br></br>
				<a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>">Edit Subject</a>
				&nbsp;
				&nbsp;
				
				<!-- link for adding a new page related to a subject -->
				</br></br><a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>">
				Add a new page to <?php echo " '" .htmlentities($current_subject["menu_name"]) . "'"; ?></a>
			<?php
			} elseif($current_page)
			{
			?>
				<h2>Manage page</h2>
				<?php echo htmlentities($current_page["menu_name"]) ; ?>
				</br></br>Position: <?php echo $current_page["position"]; ?></br>
				Visible: <?php echo $current_page["visible"]==1? 'yes': 'no'; ?></br></br>
				<div class="view-content">
				<?php echo htmlentities($current_page["content"]); ?>
				</div>
				&nbsp;
				&nbsp;
				<a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">Edit Page</a></br></br>
				<a href="delete_page.php?page=<?php echo $current_page["id"];?>" onclick="return confirm('Are you sure ?');">  Delete page</a>
			<?php
			}
			else
			{
				echo "Select a subject or a page";
			}
			?>
				
			
			 
		</ul>
	</div>
</div>

	
<?php include("../includes/layouts/footer.php"); ?>