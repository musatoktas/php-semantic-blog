<!DOCTYPE html>
<html>
<head>
	<title>Musa Toktas' Official Blog</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<meta charset="utf-8">
</head>
<body>
	
	<div class="ui inverted vertical masthead center aligned segment" style="background-color: #ffffff;">
        <div class="ui center aligned container">
            <div class="ui">
              <!-- <a href="https://semantic-ui.com/examples/fixed.html#" class="header item"> -->
              	<div class="ui secondary pointing menu">
			     	<h1 class="header" style="color: black;">
					    Musa's Blog
					</h1>
				</div>
      		<!-- </a> -->
            </div>
        </div>
    </div>
	<div class="ui container">

		<?php require('includes/config.php'); ?>	
		
		<?php

			$sql_query = $db->query("SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC");
			
			if($sql_query->rowCount())
			{	
			
				foreach($sql_query as $selection)
				{
					$date = $selection["postDate"];
					
					$descr = $selection["postDesc"];

					$title = $selection["postTitle"];

					$id = $selection["postID"];

					
					?>
					<div class="ui raised segment">
					    <a class="ui grey right ribbon label">Posted on <?php echo $date ?> </a>
					    <span><h1 class="ui centered blue header"> <?php echo $title ?> </h1></span>
					    <p class="medium description" style="font-size: 14pt;"><?php echo $descr ?></p> <!-- icerik -->
				  	
				  	<button class="ui right labeled icon teal button" >
					  <a style="color: white;" href="postdetail.php?id=<?php echo $id?>"><i style="color: white;" class="right arrow icon"></i>
					  Read More</a>
					</button>
					</div>
					<?php
					}
				}
			?>
			
			
			
			
		  	
		
		
		
	</div>

</body>
</html>