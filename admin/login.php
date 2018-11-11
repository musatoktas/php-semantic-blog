<?php
//include config
require_once('../includes/config.php');


//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!DOCTYPE html>

<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Standard Meta -->
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>MT's Blog Admin Login</title>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
  <meta charset="utf-8">
  <script src="./Login Example - Semantic_files/jquery.min.js.indir"></script>
  <script src="./Login Example - Semantic_files/form.js.indir"></script>
  <script src="./Login Example - Semantic_files/transition.js.indir"></script>

  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            username: {
              identifier  : 'Username',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your Username'
                },
                {
                  type   : 'Username',
                  prompt : 'Please enter a valid Username'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        Log-in to your account
      </div>
    </h2>

<?php

  //process login form if submitted
  if(isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if($user->login($username,$password)){ 

      //logged in return to index page
      header('Location: index.php');
      exit;
    

    } else {
      $message = '<p class="error">Wrong username or password</p>';
    }

  }
  //end if submit

  if(isset($message)){ echo $message; }
  ?>

    <form class="ui large form" action="" method="post">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="username" type="text" name="username" value=""placeholder="Username">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" value="" placeholder="Password">
          </div>
        </div>
        <button class="ui fluid large teal submit button" type="submit" name="submit" value="Login">Login</button>
      </div>

      <div class="ui error message"></div>

    </form>

  </div>
</div>




</body></html>