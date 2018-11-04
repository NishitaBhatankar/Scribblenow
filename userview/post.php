<?php 
require_once('DB.php');
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--responsive-->
    <meta name="description" content="Scribble Now-Blogging website"><!--search eng-->
    <meta name="author" content="Nishita Bhatankar" >
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Posts</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="index.css" rel="stylesheet">
  </head>

  <body>
<!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
      <a class="navbar-brand" href="index.php" style="color:#06266b;"><strong>SCRIBBLE NOW</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          
          
          <li class="nav-item">
            <a class="nav-link" href="admin/image.php">Images</a>
          </li>
          
        </ul>
        
        <form class="form-inline mt-2 mt-md-0" action="index.php" method="post">
          <button class="btn btn-primary"><a href="admin/login_form.php" style="color:white">User Login</a></button>
        </form>
        
              
    </nav>

</div>

              <br>
              <br>
              <br>
              <br>
              
              <!--POSTS-->
              <?php 
if(isset($_GET['post_id'])) 
{
	$post_id=$_GET['post_id'];
	
	$views_query="UPDATE `posts` SET `views`=views + 1 WHERE `posts`.`id`=$post_id";
	mysqli_query($connection,$views_query);
	$query="SELECT * FROM posts WHERE status='publish' and id=$post_id";
	$run=mysqli_query($connection,$query);
	if(mysqli_num_rows($run)>0)
	 {
	 	
	 	
	 	while($row=mysqli_fetch_array($run))  
	 	{
	 	$id=$row['id'];
		$date=getdate($row['date']);
		$day=$date['mday'];
		$month=$date['month'];
		$year=$date['year'];
		$title=$row['title'];
		$author=$row['author'];
		$author_image=$row['author_image'];
		
		$post_data=$row['post_data'];
	 	?>
              <div class="container">
              <div class="row">
              <div class="col-md-9">
              <div>
              <span class="d-block p-2 bg-light text-dark rounded">
              <div class="row">
              <div class="col-sm-6">
              <p style="">Author : <span><?php echo $author; ?></span></p>
              <div class="day"><?php echo $day;?>
              <?php echo $month;?>
              <?php echo $year;?></div>
              </div> <!--col 6-->
              <div class="col-sm-6">
              <a href="#" style="float:right" ><img style="height:50px; weight:50px;" src="images/<?php echo $author_image; ?>" alt="Not available"></a>
              </div> <!--col 6-->
					</div><!-- row in author--> 
					</span>             
              </div> <!--author-->
              
              	<br>
              <a href="post.php?post_id=<?php echo $id;?>" style="text-decoration:none;color:black;"><p class="font-weight-normal text-uppercase" style="font-size:50px;"><?php echo $title; ?></p></a>
              <br>
              <div class="desc"><?php echo $post_data; ?></div>
					<br>
					<br> 
					<span class="d-block p-2 bg-light text-dark rounded">
						<span class="first"><i class="far fa-smile" style="padding-right:10px;"></i>Thank you!</span>
											
					</span>
					<?php 
				}            	
  }
	 else 
	 {
	 	header('Location: index.php');
	 }
}
?>            
              	<br>
              	<h4><?php echo $author; ?> <br>Recent posts</h4>
              	<span class="d-block p-2 bg-light text-dark rounded">
              	<div class="row">
              	<?php 
						$r_query="SELECT * FROM posts WHERE status='publish' AND author='$author' LIMIT 4 ";
						$r_run=mysqli_query($connection,$r_query);
						while($r_row=mysqli_fetch_array($r_run)) 
						{
							$r_id=$r_row['id'];
							$r_title=$r_row['title'];
							$r_image=$r_row['author_image'];              	
              	?>
						<div class="col-md-2">
						<a href="post.php?post_id=<?php echo $r_id;?>"><img style="height:50px; weight:50px;" src="images/<?php echo $r_image?>" alt=""></a>
						<br><a href="post.php?post_id=<?php echo $r_id;?>" ><?php echo $r_title?></a>
						</div> <!--col-4 1-->
						<?php } ?>
					</div>
              	</span>
              	<br>
              	
              	<!-- author info-->
              <!--	<h4> About Author</h4>
              	<div class="row">
              	<div class="col-md-12">
              	<span class="d-block p-2 bg-light text-dark rounded">
              	<div class="row">
						<div class="col-md-3"><a href="#"  style="text-decoration:none;"><img style="height:50px; weight:50px;" src="images/<?php echo $author_image ?>" alt=""> <p style="color:black;"><?php echo ucfirst($author);?></p></a>
						</div> 
						
						<?php 
							//author info
							$bio_query="SELECT * FROM users WHERE username=$author";	
							$bio_run=mysqli_query($connection,$bio_query);
							echo $bio_run;
							if(mysqli_num_rows($bio_run) > 0) 
							{
								$bio_row=mysqli_fetch_array($bio_run);
								$author_details=$bio_row['details'];
												
						?>
						
						
						<div class="col-md-12"><p><?php echo $author_details;?></p>
						<?php  
							}						
						?>
						</div>             	
              	</div>
              	</span>
              	</div>
              	</div>
              	<br>
              	-->
              	
              	<!-- comments-->
              	
              	<div class="row">
						<div class="col-md-12"><a href="#" style="text-decoration:none;color:black;" ><h4>Comments</h4></a>
              	<?php 
						$c_query="SELECT * FROM comments WHERE status='approve' AND post_id=$post_id ORDER BY id DESC";
						$c_run=mysqli_query($connection,$c_query);
						if(mysqli_num_rows($c_run)>0) 
						{
							while($c_row=mysqli_fetch_array($c_run)) 
							{
								$c_id=$c_row['id'];
								$c_name=$c_row['name'];
								$c_username=$c_row['username'];
								$c_image=$c_row['image'];
								$c_comment=$c_row['comment'];               	
              	?>
              	<span class="d-block p-2 bg-light text-dark rounded">
						 <div class="row single-comment">
						<div class="col-md-2"><img style="height:50px; weight:50px;" src="images/<?php echo $c_image;?>" alt="profile pic">
						</div> 
						<br>
						<div class="col-md-10"><h4><?php echo ucfirst($c_name);?></h4><p style="color:grey;"><?php echo $c_comment;?></p>
						</div> 
						<br>
						<br>
						<br>
						</div> 
						</div>            	
              	</div>
              	</span>
              	<br>
              	<br>
             <?php 
					}
				} 
				else 
				{
					echo "no comments available";
				}
				            
             ?>
             
             <!-- form comment-->	
             
             <?php 
					if(isset($_POST['submit'])) 
					{
						$cs_name=$_POST['name'];
						$cs_email=$_POST['email'];
						//$cs_website=$_POST['website'];
						$cs_comment=$_POST['comment'];
						$cs_date=time();
						if(empty($cs_name) or empty($cs_email) or empty($cs_comment)) 
						{
							$error_msg="All (*) fields should be entered";
						}
						else 
						{
							$cs_query="INSERT  INTO `comments`(`id`,`date`,`name`,`username`,`post_id`,`email`,`image`,`comment`,`status`) VALUES (NULL ,'$cs_date','$cs_name','user','$post_id','$cs_email','profitle.jpeg','$cs_comment','pending')";
							if(mysqli_query($connection,$cs_query)) 
							{
								$msg="comment submitted (please wait for approval)";
							}
							else 
							{
								$error_msg="comment not submitted";
							}
						}
					}
								
								             
             ?>
              	<form action="" method="post">
  <div class="form-group">
    <label for=>Full name *</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Full name">
    
  </div>
  <div class="form-group">
    <label for=>Email id *</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Comment *</label>
    <textarea class="form-control" name="comment" id="comment" placeholder="Enter Comment" rows="10"></textarea>
  </div>
  <input type="submit" name="submit" class="btn btn-primary" value="submit comment">
<?php 
if(isset($error_msg)) 
{
	echo" <span style='color:red;' class='pull right'>$error_msg</span>";
}
elseif(isset($msg)) 
{
	echo" <span style='color:blue;' class='pull right'>$msg</span>";
}
?>
</form>
              	</div> <!--col-md-9-->
					</div> <!-- row-->              	
              </div><!-- container-->
</body>
</html>