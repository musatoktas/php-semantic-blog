<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();


$date = $row["postDate"];
					
$content = $row["postCont"];

$title = $row["postTitle"];





//if post does not exists redirect user.


if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Musa's Blog</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
</head>
<body>
<!--  menu-->
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
<!-- post detail-->    
		

	<div class="ui container">
		<div class="ui raised segment">
			    <a class="ui grey right ribbon label">Posted on <?php echo $date ?></a>
			    <span><h1 class="ui centered blue header"> <?php echo $title ?></h1></span>
			    <p class="medium description" style="font-size: 14pt;"><?php echo $content ?></p> <!-- icerik -->
		  	
		  
			</div>
	</div>
<!-- <div class=""></div> -->

</body>
</html>