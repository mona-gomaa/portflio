<?php
session_start();
 require_once('inc/db-connection.php');

if(isset($_POST['submit']))
{


   $name=htmlspecialchars(trim($_POST['name']));
   $desc=htmlspecialchars(trim($_POST['desc']));
   $file=$_FILES['file'];
   $url=htmlspecialchars(trim($_POST['url']));
   $repo=htmlspecialchars(trim($_POST['repo']));

   $fileName=$file['name'];
   $fileTmpName=$file['tmp_name'];
   $fileError=$file['error'];

   $ext=pathinfo($fileName,PATHINFO_EXTENSION);

   $fileNewName=uniqid().".".$ext;

   $errors=[];

   if(empty($name))
   {
       $errors[]='Name is Required';
   } elseif (strlen($name)<5 || strlen($name)>255)
   {
           $errors[]='Length Must be [5-255]';
   } else if (!is_string($name) || is_numeric($name))   
   {
       $errors[]='Name must be String';
   }

   if(empty($desc))
   {
       $errors[]='Name is Required';
   } elseif (strlen($desc)<5 || strlen($desc)>1000)
   {
           $errors[]='Length Must be [5-1000]';
   } 

   if($fileError>0)
   {
       $errors[]='There is an Error while uploading the file';
   }

   if(!filter_var($url,FILTER_VALIDATE_URL)) 
   {
         $errors[]='Website URL must be valid URL';
   }
   if(!filter_var($repo,FILTER_VALIDATE_URL))
   {
         $errors[]='Github must be valid URL';
   }
  
  if(empty($errors))
  {
     $query="INSERT INTO PROJECTS (name,description,img,url,repo) 
     values ('$name','$desc','$fileNewName','$url','$repo')";
     $run_query=mysqli_query($conn,$query);
       move_uploaded_file($fileTmpName,"images/$fileNewName");
        header("location:index.php");
  }else 
  {
      $_SESSION['errors']=$errors;
      header("location:addProjectForm.php");
  }



}



?>