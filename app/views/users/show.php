<?php
    //require_once('../../functions.php');




    // $id = null;
    // if ( !empty($_GET['id'])) {
    //     $id = $_REQUEST['id'];
    // }
    
    // if ( null == $id ) {
    //     header("Location: users.php");
    // } else {
    //     //$sql = R::getAll("SELECT * from user WHERE id = '$id'");
    //     $db = new \mysqli('localhost', 'root', '', 'mydb');
    //     $sql = $db->query("SELECT * from user WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
    //     $db->close();
    // }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read</title>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
     
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap core JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
     
<div class="span10 offset1">
    <?php foreach ($sql as $unit) { ?>
    <div class="row">
        <h2><?= $unit['first_name'] ?></h2>
    </div>
     
    <div class="form-horizontal" >
      <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['first_name'] . " " . $unit['last_name'] ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Email Address</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['email'] ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Birthday</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['birthday'] ?>
            </label>
        </div>
      </div>
      <?php } ?>
        <div class="form-actions">
          <a class="btn" href="/sportbuddy/users">Back</a>
       </div>
     
      
    </div>
</div>
 
    </div> <!-- /container -->
  </body>
  </html>