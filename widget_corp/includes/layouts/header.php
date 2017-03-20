<html lang="en">
	<head>
		<?php if(!isset($layout_context))
		{
			$layout_context="public";
		}
		?>
		<title>Widget Corp<?php if($layout_context=="admin") echo " Admin";?></title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />  <!-- Link tag is used to link to external style sheets. The option media specifies on what 
		                                                                                     device the linked document is displayed, the rel option defines the relation between the 
																							 current document and the linked one and type defines the media type of the linked document-->                         	
		<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">      
	</head>
	<body>
	<div id="header">      																	<!-- div tag defines a division or section in an html document. It is used frequently to 
																							 group block elements and to format them with CSS-->                                                                 
		<h1>Widget Corp<?php if($layout_context=="admin")echo " Admin"?></h1>
	</div>