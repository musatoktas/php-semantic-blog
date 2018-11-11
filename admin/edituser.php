<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<html>
<head>
	<title>Musa Toktas' Official Blog</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<meta charset="utf-8">
</head>
<body>
	<?php include("menu.php");?>
	<div class="ui container">
		<div class="ui grid">
			<div class="six wide column">
				
	<p><a href="users.php">User Admin Index</a></p>

	<h2>Add User</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if( strlen($password) > 0){

			if($password ==''){
				$error[] = 'Please enter the password.';
			}

			if($passwordConfirm ==''){
				$error[] = 'Please confirm the password.';
			}

			if($password != $passwordConfirm){
				$error[] = 'Passwords do not match.';
			}

		}
		

		if($email ==''){
			$error[] = 'Please enter the email address.';
		}

		if(!isset($error)){

			try {

				if(isset($password)){

					$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

					//update into database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':password' => $hashedpassword,
						':email' => $email,
						':memberID' => $memberID
					));


				} else {

					//update database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':email' => $email,
						':memberID' => $memberID
					));

				}
				

				//redirect to index page
				header('Location: users.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>
				<form class="ui form" action="" method="post">
					<input type='hidden' name='memberID' value='<?php echo $row['memberID'];?>'>
						<div class="field">
						   <label>Username</label>
						   <input type="text" name="username" placeholder="Select Username" value="<?php  echo $row['username'];?>'">
						</div>
						<div class="field">
						   <label>Password</label>
						    <input type="text" name="password" placeholder="Select Password" value=''>
						  </div>
						  <div class="field">
						    <label>Confirm Password</label>
						    <input type="text" name="passwordConfirm" placeholder="Confirm Password" value=''>
						  </div>
						  <div class="field">
						    <label>Email</label>
						    <input type="text" name="email" placeholder="Email" value='<?php echo $row['email'];?>'>
						  </div>
						  <button class="ui primary button" type='submit' name='submit' value='Update User'>Submit</button>
				</form>
			</div>
		</div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {
      $("#users").addClass( "active" );
  })
</script>	
</body>
</html>