<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
  <script src="js/jquery-3.3.1.js "></script>

   <script>
 $(document).ready(function(){

    $("#but_upload").click(function(){

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response); 
                    $(".preview img").show(); // Display image element
                }else{
                    alert('file not uploaded');
                }
				  return false;
            },
        });
    });
});
 </script>
 <style>
 
 * Container */
.container{
   margin: 0 auto;
   border: 0px solid black;
   width: 50%;
   height: 250px;
   border-radius: 3px;
   background-color: ghostwhite;
   text-align: center;
}
/* Preview */
.preview{
   width: 100px;
   height: 100px;
   border: 1px solid black;
   margin: 0 auto;
   background: white;
}

.preview img{
   display: none;
}
/* Button */
.button{
   border: 0px;
   background-color: deepskyblue;
   color: white;
   padding: 5px 15px;
   margin-left: 10px;
}
 </style>
</head>
<body>
<div class="container">

  <form enctype="multipart/form-data"  method="POST">
    <p>Upload your file</p>
     <div class='preview'>
            <img src="" id="img" width="100" height="100">
        </div>
        <div>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload" id="but_upload"></input>
    </div>
  </form>
  </div>
</body>
</html>
<?PHP
  if(!empty($_FILES['uploaded_file']))
  {
	  $name= $_FILES['uploaded_file']['name'];
    $path = "upload/";
	$new_name = $path.time().microtime()."-".$name;
    $path = $path . basename($new_name);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
	  exit();
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>