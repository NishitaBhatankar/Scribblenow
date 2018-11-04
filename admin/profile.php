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

<?php 
$session_username=$_SESSION['username'];
$query="SELECT * FROM users WHERE username='$session_username'";
$run=mysqli_query($connection,$query);
$row=mysqli_fetch_array($run);

$image=$row['image'];
$id=$row['id'];
$date=getdate($row['date']);
$day=$date['mday'];
$month=substr($date['month'],0,3);
$year=$date['year'];
$first_name=$row['first_name'];
$last_name=$row['last_name'];
$username=$row['username'];
$email=$row['email'];
$role=$row['role'];


?>
<!DOCTYPE>
 
<html>
    <head>
        <title>Admin Profile</title>
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
    <body id="profile">

        
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
    				<h1 style="color: dodgerblue;">Profile</h1>
    			<hr>
    				<span class="d-block p-2 bg-light text-dark rounded">User Details</span>
    				<br>
    				<center><img src="../images/<?php echo $image; ?>" id="profile-img" width="200px" class=" img-thumbnail"></center>
    				<br>
    				<a href="edit-profile.php?edit=<?php echo $id; ?>" class="btn btn-primary pull-right">Edit profile</a>
    				<br>
    				<br>
    				<hr>
    				<center><h3 style="color:#007bff;">PROFILE DETAILS</h3></center>
    				<br>
    				<table class="table table-hover border responsive" >
						<tr >
							<td width="30%"><b>User id:<b></td>
							<td width="20%"><?php echo $id; ?></td>
							<td width="30%"><b>Sign-up date:<b></td>
							<td width="20%"><?php echo "$day $month $year"; ?></td>						
						</tr> 
						
						<tr>
						<td width="30%"><b>First name:<b></td>
							<td width="20%"><?php echo $first_name; ?></td>
							<td width="30%"><b>Last name:<b></td>
							<td width="20%"><?php echo $last_name; ?></td>	
							</tr> 
							
							<tr>
							<td width="30%"><b>username:<b></td>
							<td width="20%"><?php echo $username; ?></td>
							<td width="30%"><b>Email id:<b></td>
							<td width="20%"><?php echo $email; ?></td>								
							</tr>  
							
							<tr>
							<td width="30%"><b>Role:<b></td>
							<td width="20%"><?php echo $role; ?></td>
							<td width="40%"><b><b></td>
							<td width="10%"></td>								
							</tr>  				
    				</table>
    				
    				
     			</div><!--column 9-->
</div> <!-- Ending of Row-->
     
</div>  <!-- Ending of Container-->


 
 
         
    </body>
</html>