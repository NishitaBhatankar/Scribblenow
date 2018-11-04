<!doctype html>
<html lang="en">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--responsive-->
    <meta name="description" content="Scribble Now-Blogging website"><!--search eng-->
    <meta name="author" content="root" >
    <link rel="icon" href="../../../../favicon.ico">

    <title>Contact us</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="#" rel="stylesheet">
    
  </head>
  <body>
  <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
      <a class="navbar-brand" href="index.html" style="color:#06266b;"><strong>SCRIBBLE NOW</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link disabled" href="#images">Images</a>
          </li>
          
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        
              </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <h1 style="text-align: center;color: dodgerblue;">Contact Us</h1>
<?php 
if(isset($_POST['submit'])) 
{
	$name=mysqli_real_escape_string($connection,$_POST['name']);
	$email=mysqli_real_escape_string($connection,$_POST['email']);
	$comment=mysqli_real_escape_string($connection,$_POST['comment']);
	
	$to="nbhatankar@gmail.com";
	$header="From:$name <$email>";
	$subject="Message from $name";
	$message="Name:$name \n\n Email:$email \n\n Message:$comment";
	
	if(empty($name) or empty($email) or empty($comment)) 
	{
		$error="All fields are required";
	}
	else 
	{
		if(mail($to,$subject,$message,$header))
		{
			$msg="Message sent";
		}
		else 
		{
			$error="Message not sent";
		}
	}
}
		
?>    
    
    <div class="container">
    <form action="" method="post">
  <div class="form-group">
  <?php 
		if(isset($error))
		{
			echo "<span style='color:red' class='pull-right'>$error</span>";		
		}  
		elseif(isset($msg))
		{
			echo "<span style='color:blue' class='pull-right'>$msg</span>";		
		}  
  ?>
    <label for="name">Full name</label>
    <input type="text" class="form-control" id="full-name" name="name" placeholder="Enter Full name">
    
  </div>
  <div class="form-group">
    <label for="email">Email id</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" id="comment" name="comment" placeholder="Enter message" rows="5"></textarea>
  </div>
  <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>
</div>

    
  </body>
</html>