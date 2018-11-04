<?php require_once('../DB.php'); 
session_start();
?>

<?php 
//both author and admin
if(!isset($_SESSION['username'])) 
{
	header('Location:login_form.php');
}
?>
<!DOCTYPE>
 
<html>
    <head>
        <title>Admin Media</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
          <li class="nav-item " >
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
            
                <a class="list-group-item  " href="index.php"><i class="fa fa-table" style="padding-right:10px;"></i>Dashboard 
                </a>
              
                <a class="list-group-item" href="posts.php"><i class="fa fa-edit" style="padding-right:10px;"></i>All posts
                </a>
                
                <a class="list-group-item active" href="media.php"><i class="fa fa-database" style="padding-right:10px;"></i>Media
                </a>
              
                <a class="list-group-item" href="comments.php"><i class="fa fa-comments" style="padding-right:10px;"></i>Comments
                </a>
              
                <a class="list-group-item" href="users.php"><i class="fa fa-users" style="padding-right:10px;"></i>Users
                </a>
              
    			</div> 
    			</div> <!-- column 3-->
    			<div class="col-md-9">
    			<br>
    				<h1 style="color: dodgerblue;">Media</h1>
    			<hr>
    			<br>
<?php 
if(isset($_POST['submit'])) 
{
	if(count($_FILES['media']['name']) > 0) 
	{
		for($i=0;$i< count($_FILES['media']['name']);$i++) 
		{
			$image=$_FILES['media']['name'][$i];
			$tmp_name=$_FILES['media']['tmp_name'][$i];
			
			$query="INSERT INTO `media` (`image`) VALUES ('$image')";
			if(mysqli_query($connection,$query)) 
			{
				$path="media/$image";
				if(move_uploaded_file($tmp_name,$path))
				{
					copy($path,"../$path");				
				}
			}
			}
		}
	}
?>    			
    			
    			<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="image">Images: </label>
						<input type="file" name="media[]" required multiple>					
					</div>
					
  					<input type="submit" value="Add media" name="submit" class="btn btn-primary btn-sm">
    			
    			</form>
    			<br>
    			<hr>
    			<br>
    			
    			<div class="row">
    			
    			<?php 
             $get_query="SELECT * FROM media ORDER BY id DESC";
             $get_run=mysqli_query($connection,$get_query); 
             if(mysqli_num_rows($get_run)>0) 
             {
             	while($get_row=mysqli_fetch_array($get_run)) 
             	{
             		$get_image=$get_row['image'];
             
                			
    			?>
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
						<a href="media/<?php echo $get_image;?>" class="thumbnail"><img src="media/<?php echo $get_image;?>" alt="image" width="100%"></a>					
					</div> 
					
					<?php 
						}
					}
             else 
             {
             	echo "<center><h2 style='color:red;'>No media available</h2></center>";
             }					
					?>
					    			
    			</div>
    				
    				
    		
     			</div><!--column 9-->
</div> <!-- Ending of Row-->
     
</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>