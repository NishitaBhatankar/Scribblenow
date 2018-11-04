<?php require_once('../DB.php'); 
session_start();
?>

<?php 
//both author and admin
if(!isset($_SESSION['username'])) 
{
	header('Location:login_form.php');
}

$session_username=$_SESSION['username'];
$session_role=$_SESSION['role'];
$session_author_image=$_SESSION['author_image'];

if(isset($_GET['edit'])) 
{
	$edit_id=$_GET['edit'];
	if($session_role=='admin') 
	{
		$get_query="SELECT * FROM posts WHERE id=$edit_id";
		$get_run=mysqli_query($connection,$get_query);
}
elseif($session_role=='author') 
{
	$get_query="SELECT * FROM posts WHERE id=$edit_id AND author='$session_username'" ;
	$get_run=mysqli_query($connection,$get_query);
}	
	
	if(mysqli_num_rows($get_run)>0)
	{
		$get_row=mysqli_fetch_array($get_run);
		$title=$get_row['title'];
		$post_data=$get_row['post_data'];
		$status=$get_row['status'];
		
	}
	else 
	{ echo "bad";
		header('Location:posts.php');
	}

}
		
?>
<!DOCTYPE>
 
<html>
    <head>
        <title>Admin Edit post</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                 
                 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                 <script>
  tinymce.init({
    selector: '#textarea'
  });
  </script>
  
  
        <link rel="stylesheet" href="css/adminstyles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    th{
    color:black;
    background-color: #ede9ed;
     
}
 
</style>
                 
    </head>
    <body>

        
        <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.html" style="color:#06266b;"><strong>SCRIBBLE NOW</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse" >
        <ul class="navbar-nav mr-auto" >
          <li class="nav-item" >
            <a class="nav-link" href="add-post.php">Add Post</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link " href="add-user.php">Add User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="logout.php">Logout</a>
          </li>
        </ul>
        
        
              </div>
    </nav>
<br>
<div class="container-fluid">
<div class="row">
     
   <div class="col-md-3">
          <div class="list-group">
            
                <a class="list-group-item active " href="index.php"><i class="fa fa-table" style="padding-right:10px;"></i>Dashboard
                </a>
              
                <a class="list-group-item" href="posts.php"><i class="fa fa-edit" style="padding-right:10px;"></i>All posts
                </a>
                
                <a class="list-group-item" href="media.php"><i class="fa fa-database" style="padding-right:10px;"></i>Media
                </a>
              
                <a class="list-group-item" href="comments.php"><i class="fa fa-comments" style="padding-right:10px;"></i>Comments
                </a>
              
                <a class="list-group-item" href="users.php"><i class="fa fa-users" style="padding-right:10px;"></i>Users
                </a>
              
    			</div> 
    			</div> <!-- column 3-->
    			<div class="col-md-9">
    			<br>
    				<h1 style="color: dodgerblue;">Edit post</h1>
    			<hr>
    			<br>
    			
    			<?php 
					if(isset($_POST['upload'])) 
					{
						$up_title=mysqli_real_escape_string($connection,$_POST['title']);
						
						$up_post_data=mysqli_real_escape_string($connection,$_POST['post_data']);
						//$up_tags=mysqli_real_escape_string($connection,$_POST['tags']);
						$up_status=$_POST['status'];
						//$up_image=$_FILES['image']['name'];
						//$up_image_tmp=$_FILES['image']['tmp_name'];
						
						//if(empty($up_image)) 
						//{
							//$up_image=$image;
						//} 
						if(empty($up_title) or empty($up_post_data)) 
						{
							$error="All fields required";
						}
						else 
						{
							$update_query="UPDATE `posts`  SET `title`='$up_title',`post_data`='$up_post_data',`status`='$up_status' WHERE id=$edit_id" ;
								
							if(mysqli_query($connection,$update_query)) 
							{
								$msg="Post added successfully";
								$path="images/up_$image";
								header('Location:edit-post.php?edit=$edit_id');
								if(!empty($up_image)) 
								{
									move_uploaded_file($up_image_tmp,$path);
									copy($path,"../$path");				
								}
							}
							else 
							{
								$error="Post not added";
							}
															
						}
					}    			
    			?>
    			<div class="row">
    			<form action="" method="post" style="height:400px;width:400px;text-align:left;">
  <div class="form-group">
  <?php
if(isset($msg))
{
	echo"<span class='pull-fight' style='color:blue'>$msg</span>";
}
elseif(isset($error)) 
{
	echo"<span class='pull-fight' style='color:red'>$error</span>";
}
	
?>  
    <label for="title">Title: *</label>
    <input type="text" name="title" value="<?php if(isset($title)){echo $title;}?>" class="form-control" id="title"  placeholder="Post title ">
  </div>
  
  <!--<div class="form-group">
  <a href="media.php" class="btn btn-primary">Add media</a>
  </div>-->
  
<div> <!--nicedit-->
  <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
	<textarea name="post_data" style="width:100%; height:400px;"><?php if(isset($post_data)){echo $post_data;}?></textarea>	
	</div>  
  
  
  
  <!--<div class="form-group">
    <textarea  name="post_data" class="form-control" id="textarea"  rows="10" cols="7"><?php if(isset($post_data)){echo $post_data;}?></textarea>
  </div>-->
  

	
  
  	<div class="form-group">
    <label for="status">Status: </label>
    <select class="form-control" name="status" id="status">
		<option value="publish" <?php if ((isset($status)) and ($status == 'publish')){echo "selected";} ?> >Publish</option>
		<option value="draft" <?php if((isset($status)) and ($status == 'draft')){echo "selected";} ?> >Draft</option>    
    </select>
  </div>
	
	<input type="submit" value="Update post" name="upload" class="btn btn-primary ">				
	
  </form>
    			</div>
    				
    				     			</div><!--column 9-->
</div> <!-- Ending of Row-->
     
</div>  <!-- Ending of Container-->



<!-- tinymce classic editor code---->
<script>
tinymce.init({
  selector: 'textarea#textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});</script>
 
         
    </body>
</html>