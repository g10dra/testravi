<?php include "header.php";
$error="";
if(isset($_POST['submit']) && !isset($_GET['id'])){
	$title=$_POST['title'];
	$description=$_POST['description'];

	if($title==""){
		$error.="<p>Title cannot be blank!</p>";
	}
	if($description==""){
		$error.="<p>Description cannot be blank!</p>";
	}

	if($error==''){

		$created_date=date('Y-m-d H:i:s');

		$sql = "INSERT INTO city_table  set description='".$description."',created_date='".$created_date."',title='".$title."' ";
		
		$res=$conn->query($sql);
		//print_r($conn);
		//die('here');
		if($res){
			header('location:city.php?success=1&msg=City posted Successfully');
		}
		else{
			$error="City posted Failed!";
			
		}

	}
}
if(isset($_POST['submit']) && isset($_GET['id'])){
	$title=$_POST['title'];
	$description=$_POST['description'];

	if($title==""){
		$error.="<p>Title cannot be blank!</p>";
	}
	if($description==""){
		$error.="<p>Description cannot be blank!</p>";
	}

	if($error==''){

		$created_date=date('Y-m-d H:i:s');

		$sql = "UPDATE  city_table  set description='".$description."',title='".$title."' where id='".$_GET['id']."' ";
		
		$res=$conn->query($sql);
		//print_r($conn);
		//die('here');
		if($res){
			header('location:city.php?success=1&msg=City Updated Successfully');
		}
		else{
			$error="City Updation Failed!";
			
		}

	}
}

$edit_form=0;
$title='';
$description='';
if(isset($_GET['id']) && $_GET['id']>0){
	$edit_form=1;
	$edit_id=$_GET['id'];

	$sql=" select title,description from city_table where id='".$edit_id."' ";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	$title=$row['title'];
	$description=$row['description'];


}

?>



</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		City <?php if($edit_form==1) echo "Edit"; else echo "Add"; ?>
	</div>
	<div class="panel-body">

	<?php if($error!=''){ ?>
		<div class="alert alert-danger">
			<?php echo $error; ?>
		</div>
	<?php } ?>

<div>
  <form method="post">
  	<div class="form-group">
  		<label >Title</label>
   		<input type="text" class="form-control" value="<?php echo $title; ?>" id="title" name="title" placeholder="write title here">
	</div>
	<div class="form-group">
    	<label >Description</label>
    	<textarea class="form-control" id="description" name="description" placeholder="description"><?php echo $description; ?></textarea>
	</div>
 
  
    <input type="submit"class="btn btn-success" value="submit" name="submit">
  </form>
</div>



	
	</div>
</div>
  		</div>
  		<?php include "footer.php"; ?>
  		