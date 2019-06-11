<?php include "header.php";
$error="";
if(isset($_POST['submit']) && !isset($_GET['id'])){
	 
	
	$title=$_POST['title'];
	$description=$_POST['description'];
    $city_id= $_POST['city_id'];
    $category_id= $_POST['category_id'];
    $added_by = $_SESSION['user_id'];
    $status = $_POST['status'];
    $tmp_name=$_FILES['Filename']['tmp_name'];

	if($title==""){
		$error.="<p>Title cannot be blank!</p>";
	}
	if($description==""){
		$error.="<p>Description cannot be blank!</p>";
	}
	if($city_id==""){
		$error.="<p>Select City please!</p>";
	}
	if($category_id==""){
		$error.="<p>Select category please!</p>";
	}
	if($status==""){
		$error.="<p>Select status please!</p>";
	}
	if($tmp_name==""){
		$error.="<p>please upload image!</p>";
	}
	else{
		//if image is not blank
		$check = getimagesize($tmp_name);
		$imageFileType = strtolower(pathinfo($_FILES["Filename"]['name'],PATHINFO_EXTENSION));
	    if($check == false) {
	        $error.="<p>please upload valid image file!</p>";
	    }
	    // Check file size
		elseif ($_FILES["Filename"]["size"] > (500*1024) ) {//500kb
		    $error.="<p>Sorry, your file is too large.</p>";
		}
		// Allow certain file formats
		elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		     $error.="<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
		}
	}

	if($error==''){

		 if(!empty($_FILES['Filename']))
		  {
			 $name= $_FILES['Filename']['name'];
			  $path = "upload/";
			  $new_name =time().$name;
		    $path = $path . basename($new_name);
		    move_uploaded_file($_FILES['Filename']['tmp_name'], $path);

		  }

		$created_date=date('Y-m-d H:i:s');

		$sql = "INSERT INTO post_table  set description='".$description."',created_date='".$created_date."',city_id='".$city_id."',cat_id='".$category_id."',status='".$status."',added_by='".$added_by."',image='".$new_name."',title='".$title."' ";
		
		$res=$conn->query($sql);
		
		if($res){
			header('location:post.php?success=1&msg=Post posted Successfully');
		}
		else{
			$error="Post Adding Failed!";
			
		}

	}
}
if(isset($_POST['submit']) && isset($_GET['id'])){  //for update case.... 
	$title=$_POST['title'];
	$description=$_POST['description'];
    $city_id= $_POST['city_id'];
    $category_id= $_POST['category_id'];
    $status = $_POST['status'];
    $tmp_name=$_FILES['Filename']['tmp_name'];
	if($title==""){
		$error.="<p>Title cannot be blank!</p>";
	}
	if($description==""){
		$error.="<p>Description cannot be blank!</p>";
	}
	if($city_id==""){
		$error.="<p>Select City please!</p>";
	}
	if($category_id==""){
		$error.="<p>Select category please!</p>";
	}
	if($status==""){
		$error.="<p>Select status please!</p>";
	}

	if(!empty($_FILES['Filename']['name']))
	{
		//if image is not blank
		$check = getimagesize($tmp_name);
		$imageFileType = strtolower(pathinfo($_FILES["Filename"]['name'],PATHINFO_EXTENSION));
		
	    if($check == false) {
	        $error.="<p>please upload valid image file!</p>";
	    }
	    // Check file size
		elseif ($_FILES["Filename"]["size"] > (500*1024) ) {//500kb
		    $error.="<p>Sorry, your file is too large.</p>";
		}
		// Allow certain file formats
		elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		     $error.="<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
		}
	}


	if($error==''){

		if(!empty($_FILES['Filename']))
		  {
			 $name= $_FILES['Filename']['name'];
			  $path = "upload/";
			  $new_name =time().$name;
		    $path = $path . basename($new_name);
		    move_uploaded_file($_FILES['Filename']['tmp_name'], $path);

		  }

		$created_date=date('Y-m-d H:i:s');

		$sql = "update post_table  set description='".$description."',city_id='".$city_id."',cat_id='".$category_id."',status='".$status."',title='".$title."' ";

		if(!empty($_FILES['Filename']))
		  {
		  	$sql.="  ,image='".$new_name."' ";
		  }



		$sql .= "  where id='".$_GET['id']."' ";
		
		$res=$conn->query($sql);
		//print_r($conn);
		//die('here');
		if($res){
			header('location:post.php?success=1&msg=Post Updated Successfully');
		}
		else{
			$error="Post Updation Failed!";
			
		}

	}
}

$edit_form=0;
$title='';
$description='';
$status='';
$city_id='';
$cat_id='';
$image='';
if(isset($_GET['id']) && $_GET['id']>0){
	$edit_form=1;
	$edit_id=$_GET['id'];

	$sql=" select title,description,city_id,cat_id,status,image from post_table where id='".$edit_id."' ";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	$title=$row['title'];
	$description=$row['description'];
	$status=$row['status'];
	$city_id=$row['city_id'];
	$cat_id=$row['cat_id'];
	$image=$row['image'];
}

?>



</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Post <?php if($edit_form==1) echo "Edit"; else echo "Add"; ?>
	</div>
	<div class="panel-body">

	<?php if($error!=''){ ?>
		<div class="alert alert-danger">
			<?php echo $error; ?>
		</div>
	<?php } ?>

<div>
  <form enctype="multipart/form-data"  method="post">
  	<div class="form-group">
  		<label >Title</label>
   		<input type="text" class="form-control" value="<?php echo $title; ?>" id="title" name="title" placeholder="write title here">
	</div>
	<div class="form-group">
    	<label >Description</label>
    	<textarea class="form-control" id="description" name="description" placeholder="description"><?php echo $description; ?></textarea>

	</div>
  <div class="form-group">
  <label >City</label>
 
    <select id="city_id" name="city_id"  class="form-control">
    	 <option value="">--Select--</option>
     <?php $sql="select id,title from city_table";
                $result = $conn->query($sql);
                 while ($row = mysqli_fetch_assoc($result)) {
                 	$selected_text=($city_id==$row['id'])?"selected":'';
                 	echo "<option ".$selected_text."  value='" . $row['id'] ."'>" . $row['title'] ."</option>";
                 	 }
    		?>
    </select> 
 
</div>
     <div class="form-group">
  <label >Category</label>
 
    <select id="category_id" name="category_id" class="form-control">
    	 <option value="">--Select--</option>
     <?php $sql="select id,title from category_table";
                $result = $conn->query($sql);
                 while ($row = mysqli_fetch_assoc($result)) {
                 	$selected_text=($cat_id==$row['id'])?"selected":'';
                 	echo "<option  ".$selected_text." value='" . $row['id'] ."'>" . $row['title'] ."</option>";
                 	 }
    		?>
    </select> 
 
</div>
 <div class="form-group">
  <label >Status</label>
 
    <select id="status" name="status" class="form-control">
      <option value="">--Select--</option>
     <option <?php echo ($status==0)?"selected":''; ?> value="0">Inactive</option>
     <option <?php echo ($status==1)?"selected":''; ?> value="1">Active</option>
    </select> 
 
</div>
	<div class="form-group">
  		<label >Image</label>
   		 <input class="form-control" type="file" name="Filename"> <br>
   		 <?php if(!empty($image)){
   		 	echo "<img src='upload/".$image."' style='width:50px;height:50px;' />";
   		 }?>
	</div>
   <div class="form-group">
    <input type="submit"class="btn btn-success" value="submit" name="submit">
     </div>
  </form>
</div>



	
	</div>
</div>
  		</div>
  		<?php include "footer.php"; ?>
  		