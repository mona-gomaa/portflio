<?php

require_once('inc/header.php');
require_once('inc/footer.php');

// session_destroy();
 $query='SELECT * from projects';
 $run_query=mysqli_query($conn,$query);
 //retraive more than row
 $projects=mysqli_fetch_all($run_query,MYSQLI_ASSOC);

 //print_r($projects);
 ?>


<?php if(!isset($_SESSION['email'])){?>
 <a  class="btn btn-primary" href="login.php">Log in </a>
 <?php }?>
 
 <?php if(isset($_SESSION['email'])){?>
 <a  class="btn btn-danger" href="addProjectForm.php">Add Project </a>
 <?php }?>

 <?php if(isset($_SESSION['email'])){?>
 <a  class="btn btn-danger" href="logout.php">Log out </a>
 <?php }?>


<div class="container">
<?php foreach($projects as $project){?>    
<div class="card mb-3">
<img class="img-fluid" src="images/<?php echo $project['img']?>" alt="">   
  <div class="card-body">
    <h1 class="card-title"><?php echo$project['name']?> </h1>
    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
    <a  class="btn btn-primary" href="showproject.php?id=<?= $project['id']?>">View Details </a>
    <?php if(isset($_SESSION['email'])){?>
    <a  class="btn btn-success" href="edit.php?id=<?= $project['id'] ?>">Edit </a>
    <a  class="btn btn-danger" href="delete.php?id=<?= $project['id'] ?>">Delete </a>
    <?php }?>
  </div>
</div>
<?php }?>
</div>