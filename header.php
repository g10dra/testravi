<?php include('config.php');?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Classified Website</title> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="#">CLassified</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Home Page</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="add_post.php">Add your Post</a>
    </li>
     <li class="nav-item">
      <a  class="nav-link" href="login_user.php">Log In</a>
    </li>
     <li   class="nav-item">
      <a class="nav-link" href="logout.php">Log Out</a>
    </li>
     <li   class="nav-item">
      <a class="nav-link" href="signup.php">Sign Up</a>
    </li>
  </ul>
</nav>

 <style type="text/css">
   .container{
    margin-top: 80px!important;
   }
 </style>