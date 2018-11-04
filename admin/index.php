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
        <title>Admin Dashboard</title>
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
    				<h1 style="color: dodgerblue;">Dashboard</h1>
    			<hr>
    				<span class="d-block p-2 bg-light text-dark rounded">New users</span>
    				<br>
    				
    				<?php 
						$get_users_query="SELECT * FROM users WHERE role='author' ORDER BY id DESC LIMIT 5 ";
						$get_users_run=mysqli_query($connection,$get_users_query);
						if(mysqli_num_rows($get_users_run)>0)
						{ 
						   				
    				?>
    				
    				<table class="table table-hover responsive">
						    <thead>
									<tr>
										<th>Sr</th>	
										<th>Date</th>								
									   <th>Name</th>
									   <th>Username</th>
                              <th>Role</th>									
									</tr>					    
						    </thead>
						    
						    <tbody>
						    <?php 
								while($get_users_row=mysqli_fetch_array($get_users_run)) 
								{
									$users_id=$get_users_row['id'];
									$users_date=getdate($get_users_row['date']);
									$users_day=$users_date['mday'];
									$users_month=substr($users_date['month'],0,3);
									$users_year=$users_date['year'];
									$users_firstname=$get_users_row['first_name'];
									$users_lastname=$get_users_row['last_name'];
									$users_fullname="$users_firstname $users_lastname";
									$users_username=$get_users_row['username'];	
									$users_role=$get_users_row['role'];				    
						    ?>
									<tr>
										<td><?php echo $users_id;?></td>
										<td><?php echo "$users_day $users_month $users_year";?></td>
										<td><?php echo ucfirst($users_fullname);?></td>
										<td><?php echo $users_username;?></td>
										<td><?php echo ucfirst($users_role);?></td>									
									</tr>	
									
									<?php } ?>	    
						    </tbody>


    				</table>
    				
    				<a type="submit" href="users.php" class="btn btn-primary">View all users</a>
    				<br>
    				<br>
    				<hr>
    				
    				<?php } ?>
    				<span class="d-block p-2 bg-light text-dark rounded">New posts</span>
    				<br>
    				
    				<?php 
						$get_posts_query="SELECT * FROM posts ORDER BY id DESC LIMIT 5";
						$get_posts_run=mysqli_query($connection,$get_posts_query);
						if(mysqli_num_rows($get_posts_run)>0)
						{ 
						   				
    				?>

    				<table class="table table-hover responsive">
						    <thead>
									<tr>
										<th>Sr</th>	
										<th>Date</th>								
									   <th>post title</th>
									   
                              <th>Views</th>									
									</tr>					    
						    </thead>
						    
						    <tbody>
						    <?php 
								while($get_posts_row=mysqli_fetch_array($get_posts_run)) 
								{
									$posts_id=$get_posts_row['id'];
									$posts_date=getdate($get_posts_row['date']);
									$posts_day=$posts_date['mday'];
									$posts_month=substr($posts_date['month'],0,3);
									$posts_year=$posts_date['year'];
									$posts_title=$get_posts_row['title'];
									$posts_views=$get_posts_row['views'];
												    
						    ?>
									<tr>
										<td><?php echo $posts_id;?></td>
										<td><?php echo "$posts_day $posts_month $posts_year";?></td>
										<td><?php echo $posts_title;?></td>
										<td><?php echo $posts_views;?></td>
																	
									</tr>	
<?php } ?>	 									
											    
						    </tbody>
    				</table>
    				<?php } ?>
    				<a type="submit" href="posts.php" class="btn btn-primary">View all posts</a>
     			</div><!--column 9-->
</div> <!-- Ending of Row-->
     
</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>