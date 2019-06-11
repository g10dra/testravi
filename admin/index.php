<?php include('../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<title>Admin Login</title>
<style>
* { margin: 0px; padding: 0px; }
body {
	font-size: 120%;
	background: #F8F8FF;
}
.header {
	width: 60%;
	margin: 50px auto 0px;
	color: white;
	background: #5F9EA0;
	text-align: center;
	border: 1px solid #B0C4DE;
	border-bottom: none;
	border-radius: 10px 10px 0px 0px;
	padding: 20px;
}
form, .content {
	width: 60%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 10px 10px;
}
.input-group {
	margin: 10px 0px 10px 0px;
}
.input-group label {
	display: block;
	text-align: left;
	margin: 3px;
}
.input-group input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
#user_type {
	height: 40px;
	width: 98%;
	padding: 5px 10px;
	background: white;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.btn {
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5F9EA0;
	border: none;
	border-radius: 5px;
}
.error {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}
.success {
	color: #3c763d; 
	background: #dff0d8; 
	border: 1px solid #3c763d;
	margin-bottom: 20px;
}
.profile_info img {
	display: inline-block; 
	width: 50px; 
	height: 50px; 
	margin: 5px;
	float: left;
}
.profile_info div {
	display: inline-block; 
	margin: 5px;
}
.profile_info:after {
	content: "";
	display: block;
	clear: both;
}



</style>
<?php

if (isset($_POST['submit'])){

 $error_message="";
 $email1 = $_POST['email'];
 $password1 = md5($_POST['password']);
   $sql= "select id from user_table where email='$email1' and password='$password1' and is_admin=1";
$result = $conn->query($sql);
if($result->num_rows>0){
$row=$result->fetch_assoc();

	$_SESSION['admin_id']=$row['id'];
	//print_r($_SESSION);
	//die();
	 header("Location:welcome.php");
	}
else{
	$error_message="invalid credentials..";
}


    
    

  }
?>
</head>
<body>
<div class="header">
	<h2>Login</h2>
</div>
<form method="post" action="index.php">
	 
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" >
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div> 
	<div class="input-group">
		<button type="submit" class="btn" name="submit">Login</button>
	</div>
	<div <?php if(isset($_POST['submit'])) echo'class="alert alert-danger"'; ?>>
			<?php echo"invalid credentials" ;?>
		</div>
	 
</form>
</body>
</html>
