<?php include "header.php";
if(isset($_GET['action']) && $_GET['action']=='delete' && $_GET['id']>0){
$sql="delete from post_table where id='".$_GET['id']."' "; 
$res=$conn->query($sql);
if($res){	
	header('location:post.php?success=1&msg=Post Deleted successfully.');	
}
else{	
	header('location:post.php?success=0&msg=Post Deleted failed.');	
}

}
$success_message='';
$searched_text='';
$error_message='';
if(isset($_GET['success']) && $_GET['success']==1){
	$success_message=$_GET['msg'];
}
if(isset($_GET['success']) && $_GET['success']==0){
	$error_message=$_GET['msg'];
}

if(isset($_GET['search']) && $_GET['search']!=''){
	$searched_text=$_GET['search'];
}

?>



</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		post
		<a href="post_form.php" class="btn btn-primary">Add new</a>



	</div>
	<div class="panel-body">

		<form method="get"><input type="text"  value="<?php echo $searched_text; ?>" style="width:20%!important;float:left" class="form-control" name="search" />
			&nbsp;&nbsp;
			<input type="submit" class="btn btn-primary" style="float:left;margin-left: 10px;" value="Search" />

		</form>
		<br>

		<?php if($success_message!=''){ ?>
		<div class="alert alert-success">
			<?php echo $success_message; ?>
		</div>
	<?php } ?>
	<?php if($error_message!=''){ ?>
		<div class="alert alert-danger">
			<?php echo $error_message; ?>
		</div>
	<?php } ?>
<?php 	
$limit=10;
$page=(isset($_GET['page']))?$_GET['page']:1;
$offset=($page-1)*$limit;
$sql="select p.*,c.title as cat_title,ct.title as city_title from post_table p join category_table c on c.id=p.cat_id join city_table ct on ct.id =p.city_id where 1  ORDER BY  p.created_date DESC ";

if(isset($searched_text) && $searched_text!=''){
	$sql.="  and ( p.title like '%".$searched_text."%' or  p.description like '%".$searched_text."%' ) ";
}

$sql .=" limit  ".$offset.",".$limit;

$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {


$total_sql="select count(*) as total_records from post_table p join category_table c on c.id=p.cat_id join city_table ct on ct.id =p.city_id where 1 ";

if(isset($searched_text) && $searched_text!=''){
	$total_sql.="  and ( p.title like '%".$searched_text."%' or  p.description like '%".$searched_text."%' )  ";
}	


$total_result = $conn->query($total_sql);
$total = mysqli_fetch_assoc($total_result);
$count=$total['total_records'];
$total_pages=ceil($count/$limit);


	 echo "<table  style='overflow-x:auto;' class='table' >
<tr>
	<th>id</th>
	<th>title</th>
	<th>Category</th>
	<th>City</th>
	<th>Description</th>
	<th>image</th>
	<th>created date</th>
	<th>updated date</th>
	<th>Action</th>
	
</tr>";

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
  
      echo "<tr  height=20>
	<td>".$row['id']."</td>
	<td><div >".$row['title']."</div></td>
	<td><div >".$row['cat_title']."</div></td>
	<td><div >".$row['city_title']."</div></td>
	<td><div >".$row['description']."</div></td>
	<td><div ><img style='width:50px;height:50px;' src='upload/".$row['image']."' /></div></td>
	<td><div >".$row['created_date']."</div></td>
	<td><div >".$row['updated_date']."</div></td>
	
	
	<td><a  class='btn btn-success' href='post_form.php?id=".$row['id']."' >Edit</a>
	<a class='btn btn-danger' href='post.php?action=delete&id=".$row['id']."' onClick=\"return confirm('are you want to delete?')\">Delete</a></td>
</tr>"; // To manage row style
}

echo "</table>";
?>

<ul class="pagination">
   <?php for($i=1;$i<=$total_pages;$i++) {?>
  <li  <?php if($page==$i) echo ' class="active" '; ?>  ><a href="post.php?page=<?php echo $i; ?>&search=<?php echo $searched_text; ?>"><?php echo  $i; ?></a></li>
<?php } ?>
</ul>

<?php
}
 else {
    echo "<p>No record Found</p>";
}

?>

	</div>
</div>
  		</div>
  		<?php include "footer.php"; ?>