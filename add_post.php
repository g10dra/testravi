<?php include('header.php');?>
<?php 
if( !isset($_SESSION['user_id']) || $_SESSION['user_id']==0   )
{
header("location:login_user.php");
}
?>
<br>
<br><br>
<br>

</div>  	

	</div>
        <div class="form-row">
        	<div class="col-md-2 content">
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		
	</div>
	</div>
	<div class="panel-body">

<div>
  <form enctype="multipart/form-data"  method="post">
  	<div class="form-group">
  		<label >Title</label>
   		<input type="text" class="form-control" value="" id="title" name="title" placeholder="write title here">
	</div>
	<div class="form-group">
    	<label >Description</label>
    	<textarea class="form-control" id="description" name="description" placeholder="description"></textarea>

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
