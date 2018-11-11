<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

  $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
  $stmt->execute(array(':postID' => $_GET['delpost']));

  header('Location: index.php?action=deleted');
  exit;
} 

?>
<html>
<head>
  <title>Musa Toktas' Official Blog</title>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
  <meta charset="utf-8">
    <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
    if (confirm("Are you sure you want to delete '" + title + "'"))
    {
      window.location.href = 'index.php?delpost=' + id;
    }
  }
  </script>
</head>
<body>
  <?php include("menu.php");?>
  <div class="ui container">
    <table class="ui celled table">
      <thead>
        <tr>
          <th>Post Title</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        
        <?php

      $sql_query = $db->query("SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC");
      
      if($sql_query->rowCount())
      { 
      
        foreach($sql_query as $selection)
        {
          $date = $selection["postDate"];
          
          $title = $selection["postTitle"];

          $id = $selection["postID"];

          
          ?>
          <tr>
            <td><?php echo $title;?></td>
            <td><?php echo $date;?></td>
            <td>
              <a href="editpost.php?id=<?php echo $id ;?>">Edit</a> | 
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
      $("#blogPost").addClass( "active" );
  })
</script>
</body>
</html>