<?php 
require_once('inc/header.php');
require_once('inc/footer.php');
if (isset($_GET['id'])) 
{
    $id=$_GET['id'];
    
}else if (!isset($_GET['id'])) {
    header("location:index.php");
}
$query="SELECT * FROM projects WHERE id=$id";
$run_query=mysqli_query($conn, $query);
//retraive one row 
$project=mysqli_fetch_assoc($run_query);
//print_r($Project);

?>

<div class="container mt-5">
<div class="row">
 <div class="col-md-6">
  <img class="img-fluid" src="images/<?php echo $project['img']?>">
 
 </div>
 <div class="col-md-6">
 <h1><?php echo $project['name']?></h1>
 <p><?php echo $project['description']?></p>

 </div>

</div>

</div>