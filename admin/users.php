<?php require_once('../DB.php'); 
session_start();
?>
<?php 
//only admin can come
if(!isset($_SESSION['username'])) 
{
	header('Location:login_form.php');
}

elseif(isset($_SESSION['username']) && $_SESSION['role'] == 'author') 
{
	header('Location:index.php');
}
?>


<?php 

// delete user 
if(isset($_GET['del'])) 
{
	$del_id = $_GET['del'];
	$del_check_query="SELECT * FROM users WHERE id=$del_id";
	$del_check_run=mysqli_query($connection,$del_check_query);
	if(mysqli_num_rows($del_check_run)>0) 
	{
		$del_query="DELETE FROM `users` WHERE `users`.`id`=$del_id";
		if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin') 
		{
			if(mysqli_query($connection,$del_query)) 
		{
			$msg="User deleted successfully";
		}
		else 
		{
			$error="User has not been deleted";
		}
		}
	}
	else 
	{
		header('Location:index.php');
		} 

}
	
?>




<!DOCTYPE>
 
<html>
    <head>
        <title>Admin Users</title>
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
          <li class="nav-item ">
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
    				<h1 style="color: dodgerblue;">Users</h1>
    			<hr>
    			
    			<?php 
    			$query="SELECT * FROM users ORDER BY id DESC";
    			$run=mysqli_query($connection,$query);
    			if(mysqli_num_rows($run)>0) 
    			{
    				
    			?>
    			
    			<!--delete form-->
    			
    			<div class="row">
					
    			</div><!--row in col 9-->
    			
    			<?php
    			
    			if(isset($error)) 
    			{
    				echo "<span style='color:red' class='pull-right'>$error</span>";
    			}
    			elseif(isset($msg)) 
    			{
    				echo "<span style='color:blue' class='pull-right'>$msg</span>";
    			}
?>    			<!-- user table-->
    			<table class="table table-hover responsive table-bordered">
						    <thead>
									<tr>
										
										<th>Sr</th>	
										<th>Date</th>								
									   <th>Name</th>
									   <th>Username</th>
                              <th>Email</th>
                              <th>Image</th>	
                              <th>Password</th>	
									   <th>Role</th>
									   	
									   <th>Edit</th>
                              <th>Delete</th>	
                              										
									</tr>					    
						    </thead>
						    
						    <tbody>
						    
						    <?php
								while($row=mysqli_fetch_array($run)) 
								{
									$id=$row['id'];
									$first_name=ucfirst($row['first_name']);
									$last_name=ucfirst($row['last_name']);
									$last_name=ucfirst($row['last_name']);
									$email=$row['email'];
									$username=$row['username'];
									$role=$row['role'];
									$image=$row['image'];
									$date=getdate($row['date']);
									
									$day=$date['mday'];
									$month=substr($date['month'],0,3);
									$year=$date['year']
						    
						     ?>
									<tr>
										
										<td><?php echo $id; ?></td>
										<td><?php echo "$day $month $year"; ?></td>
										<td><?php echo "$first_name $last_name"; ?></td>
										<td><?php echo $username; ?></td>
										<td><?php echo $email; ?></td>
										<td><img src="../images/<?php echo $image; ?>" style="height:50px;width:50px;" alt="user image"></td>
										<td>********</td>	
										<td><?php echo $role; ?></td>
										<td><a href="edit-user.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
										<td><a href="users.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>	
																			
									</tr>
									
									</tbody>
									<?php 
    			}
    		}
    		else 
    		{
    			echo"<center><h3>No users available now</h3></center>";
    		}
    			?>
    			
									</table>	
									
    			</div><!--column 9-->
    			
</div> <!-- Ending of Row-->

</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>