<?php require_once('../DB.php'); 
session_start();
?>

<?php 
if(isset($_POST['submit'])) 
{
	$username=mysqli_real_escape_string($connection,$_POST['username']);
	$password=mysqli_real_escape_string($connection,$_POST['password']);
	
	$check_username_query="SELECT * FROM users WHERE username='$username'";
	$check_username_run=mysqli_query($connection,$check_username_query);
	if(mysqli_num_rows($check_username_run)>0) 
	{
		$row=mysqli_fetch_array($check_username_run);
		
		$db_username=$row['username'];
		$db_password=$row['password'];
		$db_role=$row['role'];
		$db_author_image=$row['image'];

		$password=crypt($password,$db_password);		
		
		if($username == $db_username && $password == $db_password)  
		{
			header('Location: index.php');
			$_SESSION['username']=$db_username;
			$_SESSION['role']=$db_role;
			$_SESSION['author_image']=$db_author_image;
		}
		else 
		{
			$error="wrong username or password";
		}
	}
	else 
	{
		$error="wrong username or password";
	}
}
?>

<!doctype html>
<html lang="en">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--responsive-->
    <meta name="description" content="Scribble Now-Blogging website"><!--search eng-->
    <meta name="author" content="root" >
    <link rel="icon" href="../../../../favicon.ico">

    <title>Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="#" rel="stylesheet">
    
  </head>
  <body >
  <a href="../index.php"><h1 class="btn btn-primary" style="margin:5px;">Home</h1></a>
  <br>
  <br>
  <br>
  <h1 style="text-align: center">SCRIBBLE NOW</h1>
  <br>
  <br>
  <h3 style="text-align: center;color: dodgerblue;">Login</h3>
  <div class="container">
  <center>
  <form action="" method="post" style="height:400px;width:400px;text-align:left;">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" id="username"  placeholder="Username">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
  </div> 
  
  <?php 
  
  
  if(isset($error)) 
  {
  		echo $error;
  }  	
  	?>
  <br>
  <br>
  <input type="submit" name="submit" value="Sign In" class="btn btn-primary">
</form>
</center>
</div>
  </body>
  </html>