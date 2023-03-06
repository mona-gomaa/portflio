<?php 
session_start();
require_once("inc/db-connection.php");

if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="select * from users where email='$email'";
    $run_query=mysqli_query($conn,$query);
//retraive is there are number of rows  back from db or not -> back 1/ not back 0
     echo mysqli_num_rows($run_query);

    if(mysqli_num_rows($run_query)>0)
    {
        $user=mysqli_fetch_assoc($run_query);
       $isCorrect=password_verify($password,$user['password']);
       if ($isCorrect) 
       {

        $_SESSION['email']=$email;
        header("location:index.php");
       } else
       {
            $_SESSION['errors']="password is not correct";
            print_r( $_SESSION['errors']);
            header("location:login.php");


       }
    }else{
    $_SESSION['errors']="email is not found";
    print_r( $_SESSION['errors']);
    header("location:login.php");

    }

}
?>