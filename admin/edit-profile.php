<?php require_once('../DB.php');
session_start(); 
?>

<?php 
//only admin
if(!isset($_SESSION['username'])) 
{
	header('Location:login_form.php');
}

?>

<?php
//url does contain id 

$session_username=$_SESSION['username'];
if(isset($_GET['edit'])) 
{
	$edit_id=$_GET['edit'];
	$edit_query="SELECT * FROM users WHERE id=$edit_id";
	$edit_query_run=mysqli_query($connection,$edit_query);
	if(mysqli_num_rows($edit_query_run)>0) 
	{
		
		$edit_row=mysqli_fetch_array($edit_query_run);
		$e_username=$edit_row['username'];
		if($e_username == $session_username) 
		{
			$e_first_name=$edit_row['first_name'];
		$e_last_name=$edit_row['last_name'];
		$e_image=$edit_row['image'];
		
	}
//else 
//{
	//header('Location:index.php');		
	//}
	//id in url not in database
	else 
	{
		header('Location:index.php');
	}
	
}
}
//url doesnt contain id
else 
{
	header('Location:index.php');
}
	
?>
<!DOCTYPE>
 
<html>
    <head>
        <title>Admin edit profile</title>
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
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="add-post.php">Add post </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link " href="add-user.php">Add user</a>
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
                
                <a class="list-group-item" href="media.php"><i class="fa fa-database" style="padding-right:10px;"></i>Media
                </a>
              
                <a class="list-group-item" href="comments.php"><i class="fa fa-comments" style="padding-right:10px;"></i>Comments
                </a>
              
                <a class="list-group-item active" href="users.php"><i class="fa fa-users" style="padding-right:10px;"></i>Users
                </a>
              
    			</div> 
    			</div> <!-- column 3-->

    			<div class="col-md-9">
    			<br>
    			
    				<h1 style="color: dodgerblue;">Edit Profile</h1>
    			<hr>
    			
    			<?php 
					if(isset($_POST['submit'])) 
					{
						
						$first_name=mysqli_real_escape_string($connection,$_POST['first-name']);
						$last_name=mysqli_real_escape_string($connection,$_POST['last-name']);
						$password=mysqli_real_escape_string($connection,$_POST['password']);
						
						$image=$_FILES['image']['name'];
						$image_tmp=$_FILES['image']['tmp_name'];
						//$details=$_POST['details'];
						
						if(empty($image)) 
						{
							$image=$e_image;
						}
						 
						 //encrypt password//
						$salt_query="SELECT * FROM users ORDER BY id DESC LIMIT 1";
						$salt_run=mysqli_query($connection,$salt_query);
						$salt_row=mysqli_fetch_array($salt_run);
						$salt=$salt_row['salt'];
						$insert_password=crypt($password,$salt);
						
						if(empty($first_name) or empty($last_name)  or empty($image) ) 
						{
							$error="All (*) fields required";
						}
						
						else 
						{
							$update_query="UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`image`='$image',`details`='$details'";
							if(isset($password)) 
							{							
							$update_query .=",`password`='$insert_password'";
						}
							$update_query .= "WHERE `users`.`id`='$edit_id'";
							if(mysqli_query($connection,$update_query)) 
							{
								$msg="User has been updated";
								header("refresh:1;url=edit-profile.php?edit=$edit_id");
								if(!empty($image)) 
								{
									move_uploaded_file($image_tmp,"../images/$image");
								}
							}
							else 
							{
								$error="user not updated";
							}
							
								
						}
					}
							
						    			
    			?>
    			
    			<!-- form row -->
    			<div class="row">
    				<div class="col-md-8">
    			<form action="" method="post" enctype="multipart/form-data">
					 
					
					<div class="form-group">
						<label for="first-name">First name: *</label>
						<?php 
							if(isset($error)) 
							{
								echo "<span class='pull-right' style='color:red;'>$error</span>";
							}
							elseif(isset($msg)) 
							{
								echo "<span class='pull-right' style='color:blue;'>$msg</span>";	
							}					
						?>
						<input type="text" name="first-name" value="<?php echo $e_first_name;?>" id="first-name" class="form-control" placeholder="First name">					
					</div>    
					
					<div class="form-group">
						<label for="last-name">Last name: *</label>
						<input type="text" value="<?php echo $e_last_name;?>" name="last-name" id="last-name" class="form-control" placeholder="Last name">					
					</div>    
					
					<div class="form-group">
						<label for="password">Password: *</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">					
					</div>    
					
					    
					
					<div class="form-group">
						<label for="image">Profile picture: </label>
						<input type="file" name="image" id="image">					
					</div>
					
					    
					
					<input type="submit" value="Update Profile" name="submit" class="btn btn-primary">			
    			</form>
								
									
					
    			</div> <!-- col-8-->
    			<div class="col-md-4">
    			<?php 
						
							echo "<img src='../images/$e_image ' style='width:100%;'>";
											
					?>   
    			</div><!-- col-4-->
    			</div> <!-- col-9 row-->
    			</div><!--column 9-->
    			
</div> <!-- Ending of Row-->

</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>