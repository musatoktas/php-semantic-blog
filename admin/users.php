<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['deluser'])){ 

  //if user id is 1 ignore
  if($_GET['deluser'] !='1'){

    $stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
    $stmt->execute(array(':memberID' => $_GET['deluser']));

    header('Location: users.php?action=deleted');
    exit;

  }
} 

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
    <table class="ui celled table">
      <thead>
        <tr>
          <th>Username</th>
          <th>E-mail</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

      $sql_query = $db->query("SELECT memberID, username, email FROM blog_members ORDER BY username");
      
      if($sql_query->rowCount())
      { 
      
        foreach($sql_query as $selection)
        {
          $username = $selection["username"];
          
          $mail = $selection["email"];

          $id = $selection["memberID"];

          
          ?>
          <tr>
            <td><?php echo $username;?></td>
            <td><?php echo $mail;?></td>
            <td>
              <a href="edituser.php?id=<?php echo $id ;?>">Edit</a> | 
              <a href="javascript:delpost('<?php echo $id ;?>','<?php echo $title;?>')">Delete</a>
            </td>
          </tr>
          <?php
          }
        }
      ?>
      </tbody>
    </table>  
</div>
<script type="text/javascript">
  $( document ).ready(function() {
      $("#users").addClass( "active" );
  })
</script>
</body>
</html>