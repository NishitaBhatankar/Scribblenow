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
	$del_check_query="SELECT * FROM comments WHERE id=$del_id";
	$del_check_run=mysqli_query($connection,$del_check_query);
	if(mysqli_num_rows($del_check_run)>0) 
	{
		$del_query="DELETE FROM `comments` WHERE `comments`.`id`=$del_id";
		if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin') 
		{
			if(mysqli_query($connection,$del_query)) 
		{
			$msg="Comment deleted successfully";
		}
		else 
		{
			$error="Comment has not been deleted";
		}
		}
	}
	else 
	{
		header('Location:index.php');
		} 

}
	
?>

<?php 
// approve comments
if(isset($_GET['approve'])) 
{
	$approve_id = $_GET['approve'];
	$approve_check_query="SELECT * FROM comments WHERE id=$approve_id";
	$approve_check_run=mysqli_query($connection,$approve_check_query);
	if(mysqli_num_rows($approve_check_run)>0) 
	{
		$approve_query="UPDATE `comments` SET `status`='approve' WHERE `comments`.`id`=$approve_id";
		if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin') 
		{
			if(mysqli_query($connection,$approve_query)) 
		{
			$msg="Comment approved successfully";
		}
		else 
		{
			$error="Comment has not been approved";
		}
		}
	}
	else 
	{
		header('Location:index.php');
		} 

}
	
?>

<?php 
// unapprove comments
if(isset($_GET['unapprove'])) 
{
	$unapprove_id = $_GET['unapprove'];
	$unapprove_check_query="SELECT * FROM comments WHERE id=$unapprove_id";
	$unapprove_check_run=mysqli_query($connection,$unapprove_check_query);
	if(mysqli_num_rows($unapprove_check_run)>0) 
	{
		$unapprove_query="UPDATE `comments` SET `status`='pending' WHERE `comments`.`id`=$unapprove_id";
		if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin') 
		{
			if(mysqli_query($connection,$unapprove_query)) 
		{
			$msg="Comment unapproved successfully";
		}
		else 
		{
			$error="Comment has not been unapproved";
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
        <title>Admin Comments</title>
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
            <a class="nav-link" href="add-post.php">Add post</a>
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
              
                <a class="list-group-item active" href="comments.php"><i class="fa fa-comments" style="padding-right:10px;"></i>Comments
                </a>
              
              
                <a class="list-group-item " href="users.php"><i class="fa fa-users" style="padding-right:10px;"></i>Users
                </a>
              
    			</div> 
    			</div> <!-- column 3-->
    			<div class="col-md-9">
    			<br>
    				<h1 style="color: dodgerblue;">Comments</h1>
    				
    				<hr>
    				<br>    		
    			
    			

    			
    			<?php 
    			$query="SELECT * FROM comments ORDER BY id DESC";
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
									   <th>Username</th>
                              <th>Comments</th>
                              <th>Status</th>
									   <th>Approved</th>
									   <th>Unapproved</th>
									   <th>Reply</th>
                              <th>Delete</th>	
                              										
									</tr>					    
						    </thead>
						    
						    <tbody>
						    
						    <?php
								while($row=mysqli_fetch_array($run)) 
								{
									$id=$row['id'];
									$post_id=$row['post_id'];
									$status=$row['status'];
									$comment=$row['comment'];
									$username=$row['username'];
									$date=getdate($row['date']);
									$day=$date['mday'];
									$month=substr($date['month'],0,3);
									$year=$date['year']
						    
						     ?>
									<tr>
										
										<td><?php echo $id; ?></td>
										<td><?php echo "$day $month $year"; ?></td>
										<td><?php echo $username; ?></td>	
										<td><?php echo $comment; ?></td>
										<td><?php echo $status; ?></td>
										<td><a href="comments.php?approve=<?php echo $id; ?>">Approved</a></td>
										<td><a href="comments.php?unapprove=<?php echo $id; ?>">Unapproved</a></td>
										<td><a href="comments.php?reply=<?php echo $post_id; ?>"><i class="fa fa-reply"></i></a></td>
										<td><a href="comments.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>	
																			
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