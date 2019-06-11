<?php include('header.php');?>
<?php
  $searched_text="";

 if(isset($_GET['title']) && $_GET['title']!=''){
  $searched_text=$_GET['title'];
  }

  if(isset($_GET['city']) && $_GET['city']!=''){
  $searched_city=$_GET['city'];
  }
 if(isset($_GET['category']) && $_GET['category']!=''){
  $searched_category=$_GET['category'];
  }
  ?>
    
    <div class="container"> 
  <div class="row">        
<form class="form-inline" >
  <div class="form-group"> 
    <input type="text" value= "<?php echo $searched_text; ?>" placeholder="Search your requirement here" class="form-control" name="title" />
  </div>
  <div class="form-group"> 
    <select  class="form-control" name="city" >
      <option value="">--Select City--</option>
      <?php $sql="select id,title from city_table";
       $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
        $selected_text=($searched_city==$row['title'])?"selected":'';
       echo "<option ".$selected_text."  value='" . $row['title'] ."'>" . $row['title'] ."</option>";
              }
        ?>
    
    </select>
  </div>
    <div class="form-group"> 
     <select  class="form-control" name="category" >
      <option value="">--Select Category--</option>
       <?php $sql="select id,title from category_table";
       $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
        $selected_text=($searched_category==$row['title']?"selected":"");

       echo "<option ".$selected_text."  value='" . $row['title'] ."'>" . $row['title'] ."</option>";
        }
        ?>
    
    </select>
  </div>
  
  <button type="submit" class="btn btn-primary">Search</button>
</form>
</div>

 <div class="row"> 
              <?php
               $limit=3;
              $page=(isset($_GET['page']))?$_GET['page']:1;

              $offset=($page-1)*$limit;
              $sql="select p.id,p.image,p.title,c.title as cat_title,ct.title as city_title from post_table p join category_table c on c.id=p.cat_id join city_table ct on ct.id =p.city_id where 1  ";
              $search_query='';
              if(isset($_GET['title']) && $_GET['title']!=''){
                $search_query.=" and ( p.title like '%".$_GET['title']."%' ) ";
              }
              if(isset($_GET['city']) && $_GET['city']!=''){
                $search_query.=" and ( ct.title like '%".$_GET['city']."%' ) ";
              }
               if(isset($_GET['category']) && $_GET['category']!=''){
                $search_query.=" and ( c.title like '%".$_GET['category']."%' ) ";
              }

              $sql .= $search_query;
              $sql .=" ORDER BY  p.created_date DESC  limit  ".$offset.",".$limit;
              
              $total_sql="select count(*) as total_records from post_table p join category_table c on c.id=p.cat_id join city_table ct on ct.id =p.city_id where 1 ";
                $total_sql .= $search_query;

                $total_result = $conn->query($total_sql);
                $total = mysqli_fetch_assoc($total_result);
                $count=$total['total_records'];
                $total_pages=ceil($count/$limit);

              $result = $conn->query($sql);
              if (mysqli_num_rows($result) > 0) { 
               while($row = mysqli_fetch_assoc($result)) { ?>
                
              <div class="col-lg-4">
                
                <div class="row">
                  <div class="col-lg-6">
                    <a href="detail.php?ad_id=<?php echo $row['id'];  ?>" >
                       <p><?php echo $row['title']; ?></p>
                      <p>
                      <img class="img-responsive img-thumbnail" src="admin/upload/<?php echo $row['image']; ?>" />
                    </p>

                   </a>
                 </div>
                  <div class="col-lg-6">
                      <p >Category : <?php echo $row['cat_title']; ?></p> 
                      <p>City : <?php echo $row['city_title']; ?></p> 
                                  
                  </div>
                </div>
                 

              </div>

              <?php } }else{
                ?>
                <p class="alert alert-warning">No record found</p>
                <?php
              } ?> 

 

          </div>
            <div class="row">
              <nav aria-label="...">
              <ul class="pagination">
                <?php if($total_pages>0){
                  parse_str($_SERVER['QUERY_STRING'],$query_array);
                  for($i=1;$i<=$total_pages;$i++) {
                    $query_array['page']=$i;
                    ?>
                <li class="page-item <?php if($page==$i) echo 'active'; ?>"><a class="page-link" href="?<?php echo http_build_query($query_array); ?>"><?php echo  $i; ?></a></li> 
              <?php }} ?>
              </ul>
            </nav>

       
          </div>


       
      </div>


   
 
<?php include('footer.php'); ?>