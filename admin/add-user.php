<?php require_once('../DB.php');

?>


<!DOCTYPE>
 
<html>
    <head>
        <title>Add users</title>
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
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
      	<a class="navbar-brand" href="../index.php" style="color:#06266b;"><strong>SCRIBBLE NOW</strong></a>
        
        <!-- responsive toogle button-->
      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      	</button>
      
      
         <!-- navbar fields-->
         <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
            	<li class="nav-item ">
            		<a class="nav-link" href="../index.php">Home </a>
          		</li>
          
          		<li class="nav-item">
            		<a class="nav-link" href="image.php">Images</a>
          		</li>
          
          		
          		<li class="nav-item active">
            		<a class="nav-link" href="add-user.php">Sign-up </a>
          		</li>
        		</ul>
        		
        		
        
        
         </div>
    </nav>
    <br>
<div class="container-fluid">
<div class="row">
   <div class="col-md-3"></div>  
   
    			<div class="col-md-9">
    			<br>
    			<br>
    				<h1 style="color: dodgerblue;">Create user account</h1>
    			<hr>
    			
    			<?php 
					if(isset($_POST['submit'])) 
					{
						$date=time();
						$first_name=mysqli_real_escape_string($connection,$_POST['first-name']);
						$last_name=mysqli_real_escape_string($connection,$_POST['last-name']);
						$username=mysqli_real_escape_string($connection,$_POST['username']);
						$username_trim=preg_replace("/\s+/",'',$username);
						$email=mysqli_real_escape_string($connection,$_POST['email']);
						$password=mysqli_real_escape_string($connection,$_POST['password']);
						$role=$_POST['role'];
						$image=$_FILES['image']['name'];
						$image_tmp=$_FILES['image']['tmp_name'];
						
						$check_query="SELECT * FROM users WHERE username='$username' OR email='$email'";
						$check_run=mysqli_query($connection,$check_query);
						 
						 //encrypt password//
						$salt_query="SELECT * FROM users ORDER BY id DESC LIMIT 1";
						$salt_run=mysqli_query($connection,$salt_query);
						$salt_row=mysqli_fetch_array($salt_run);
						$salt=$salt_row['salt'];
						$password=crypt($password,$salt);
						
						if(empty($first_name) or empty($last_name) or empty($username) or empty($password) or empty($email) or empty($image) ) 
						{
							$error="All (*) fields required";
						}
						elseif($username != $username_trim)  
						{
							$error="Don't use spaces in username ";
							
						}
						elseif(mysqli_num_rows($check_run)>0) 
						{
							$error="username or email already exists";
						}
						else 
						{
							$insert_query="INSERT INTO `users` (`id`,`date`,`first_name`,`last_name`,`username`,`email`,`image`,`password`,`role`) VALUES (NULL,'$date','$first_name','$last_name','$username','$email','$image','$password','$role')";
							if(mysqli_query($connection,$insert_query)) 
							{
								$msg="User added successfully";
								
								move_uploaded_file($image_tmp, "../images/$image");
								$image_check="SELECT * FROM users ORDER BY id DESC LIMIT 1";
								$image_run=mysqli_query($connection,$image_check);
								$image_row=mysqli_fetch_array($image_run);
								$check_image=$image_row['image'];
							
								$first_name="";
								$last_name="";
								$username="";
								$email="";
								
							}
							else 
							{
								$error="User not added";
							}						
						}
					}
							
						//$2y$10$quickbrownfoxjumpsoveefXkylpKMwkYHIwNPw3s3ZpboG0tqpnO// salt 123    			
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
						<input type="text" name="first-name" value="<?php if(isset($first_name)){echo $first_name;}?>" id="first-name" class="form-control" placeholder="First name">					
					</div>    
					
					<div class="form-group">
						<label for="last-name">Last name: *</label>
						<input type="text" value="<?php if(isset($last_name)){echo $last_name;}?>" name="last-name" id="last-name" class="form-control" placeholder="Last name">					
					</div>    
					
					<div class="form-group">
						<label for="username">Username: *</label>
						<input type="text" value="<?php if(isset($username)){echo $username;}?>" name="username" id="username" class="form-control" placeholder="Username">					
					</div>    
					
					<div class="form-group">
						<label for="email">Email: *</label>
						<input type="text" value="<?php if(isset($email)){echo $email;}?>" name="email" id="email" class="form-control" placeholder="Email">					
					</div>    
					
					<div class="form-group">
						<label for="password">Password: *</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">					
					</div>    
					
					<div class="form-group">
						<label for="role">Role: *</label>
						<select name="role" id="role" class="form-control">
							<option value="author">Author</option>
													
						</select>				
					</div>    
					
					<div class="form-group">
						<label for="image">Profile picture: </label>
						<input type="file" name="image" id="image">					
					</div>    
					
					<input type="submit" value="Add User" name="submit" class="btn btn-primary">			
    			</form>
								
									
					
    			</div> <!-- col-8-->
    			
    			<div class="col-md-4"> 
					<?php 
						if(isset($check_image)) 
						{
							echo "<img src='../images/$check_image ' style='width:100%;'>";
							echo "<br>";
							echo "<a class='btn btn-md btn-primary' href='../index.php'> Back to home page</a>";
						}					
					?>   			
    			</div>
    			</div> <!-- col-9 row-->
    			</div><!--column 9-->
    			
</div> <!-- Ending of Row-->

</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>