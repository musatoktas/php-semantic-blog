<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Musa Toktas' Official Blog</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>	
</head>
</body>
<!-- container -->
	<!-- form -->
		<!-- Title -->
		<!-- Description -->
		<!-- Content -->
<?php include('menu.php');?>
<div class="ui container">
	<h2>Edit Post</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//redirect to index page
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>
	<form class="ui form" action="" method="post">
	<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

	  <div class="field">
	    <label>Title</label>
	    <input type="text" name="postTitle" placeholder="Title" value="<?php echo $row['postTitle'];?>">
	  </div>
	  <div class="field">
	    <label>Description</label>
	    <textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea>
	  </div>
	  <div class="field">
	    <label>Content</label>
	    <textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea>
	  </div>
	  
	  <button class="ui button" type="submit" type='submit' name='submit' value='Submit'>Submit</button>
	</form>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
	    $("#addPost").addClass( "active" );
	})
</script>
</body>
</html>