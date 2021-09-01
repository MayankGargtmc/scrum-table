<!doctype html>
<html lang="en">
  <head>
    <title>scrum table</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <?php require_once 'process.php';?>

    <?php
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>  
    </div>

    <?php endif ?>

    <div class="container">
    <?php
    $mysqli= new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result= $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    //pre_r($result);
    ?>

    <div class="col justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>STORY</thd>
            <th>NOT STARTED</th>
            <th>IN PROGRESS</th>
            <th>DONE</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>  
    <?php
      while ($col=$result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $col['story']; ?></td>
          <td><?php echo $col['not_started']; ?></td>
          <td><?php echo $col['in_progress']; ?></td>
          <td><?php echo $col['done']; ?></td>
          <td>
          <a href="index.php?edit=<?php echo $col['id'];?>"
              class="btn btn-info">Edit</a>
          <a href="process.php?delete=<?php echo $col['id'];?>"
              class="btn btn-danger">Delete</a>
          </td>
        </tr>    
      <?php endwhile?>    
      </table>

    </div>
    <?php
    
    function pre_r($array){
      echo '<pre>';
      print_r($array);
      echo '<pre>';
    
    }
    ?>
    <div class ="row justify-content-center">
      
    <form action="process.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class ="form-group">
      <label >story</label>
      <input type="text" name="story" class="form-control"
        value="<?php echo $story?>" placeholder="enter a story">
      </div>
      <div class ="form-group">
        <?php
        if($update==true):
        ?>
        <label >not started</label>
        <input type="text" name="not_started" class="form-control"
           value="<?php echo $not_started?>" placeholder="enter the task">
           <label >in progress</label>
        <input type="text" name="in_progress" class="form-control"
           value="<?php echo $in_progress?>" placeholder="enter the task">
           <label >done</label>
        <input type="text" name="done" class="form-control"
           value="<?php echo $done?>" placeholder="enter the task">

        <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
      </div>
    </form>
    </div>
    </div>
  </body>
</html>