<?php  //database connection
require_once('DB.php');
?>

<?php
// search box	
if(isset($_POST['search'])) 
{
	$search=$_POST['search-title'];
}
?>


<!--html code-->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--responsive-->
    <meta name="description" content="Scribble Now-Blogging website"><!--search eng-->
    <meta name="author" content="root" >

    <title>Scribble Now</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="animate.css">
   </head>

<body>
<!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
      	<a class="navbar-brand" href="index.php" style="color:#06266b;"><strong>SCRIBBLE NOW</strong></a>
        
        <!-- responsive toogle button-->
      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      	</button>
      
      
         <!-- navbar fields-->
         <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
            	<li class="nav-item active">
            		<a class="nav-link" href="index.php">Home</a>
          		</li>
          
          		<li class="nav-item">
            		<a class="nav-link" href="admin/image.php">Images</a>
          		</li>
          
          
          		<li class="nav-item">
            		<a class="nav-link" href="#about">About</a>
          		</li>
          		
          		<li class="nav-item ">
            		<a class="nav-link" href="admin/add-user.php">Sign-up </a>
          		</li>
        		</ul>
        		
        		
        <form class="form-inline mt-2 mt-md-0" action="index.php" method="post">
          <button class="btn btn-primary"><a href="admin/login_form.php" style="color:white">User Login</a></button>
        </form>
        
        
         </div>
    </nav>
    
    <br>
    <br>
    <!--signup-->
   
     
        
        
            <div  style="background-color:pink; height:400px;">
            <br>
            <br>
            
                <h1 class="jumbotron-heading text-center animated bounce" style="font-size:80px;color:white; animation-duration:1s; animation-delay:0s; animation-iteration-count:infinite;"><br>Scribble Now</h1>
            	<h3 class="jumbotron-heading text-center" style="color:white;">Share Your Passion !</h3>
            	
               <!-- <h1 class="mbr-text pb-3 mbr-fonts-style display-5" style="font-size:80px; color:white;"><br><br></h1>--><br><br>
                
                
              </div>
          
    
  
       <!-- <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>-->
    
    
     
     
<!-- POSTS-->
 <div class="jumbotron jumbotron-fluid bg-white" >
        <div class="container" >
        <span class="d-block p-2 bg-light text-dark rounded">
          <h1 class="jumbotron-heading text-center animated pulse" style="animation-duration:1s; animation-delay:0s; animation-iteration-count:infinite;">RECENT POSTS</h1>
          </span>
        </div>
<?php
if(isset($_POST['search'])) 
{
	$search=$_POST['search-title'];
   $query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC ";
}
else 
{
	$query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC  LIMIT 4";
}
	
$run=mysqli_query($connection,$query);
if(mysqli_num_rows($run)>0) 
	{
		while($row=mysqli_fetch_array($run)) 
			{
				$id=$row['id'];
				$date=$row['date'];
				$title=$row['title'];
				$author=$row['author'];
				$author_image=$row['author_image'];
				$post_data=$row['post_data'];
				$views=$row['views'];
				$status=$row['status'];
			
	 
?>

      <div class="row" style="background-color:white;">
       <div class="container">       
              <!--<div>
              <span class="d-block p-2 bg-light text-dark rounded">
              <div class="row">
              <div class="col-sm-6">
              <p style="">Written by:<span><?php echo ucfirst($author); ?></span></p>
              </div> <!--col 6-->
              <!--<div class="col-sm-6">
              <a href="#" style="float:right" ><img style="height:50px; weight:50px;" src="images/<?php echo $author_image; ?>" alt="Not available"></a>
              </div> <!--col 6-->
					<!--</div><!-- row in author--> 
					<!--</span>             
              </div> <!--author-->
              	<!--<div class="image"> <img src="images/<?php echo $image; ?>"> </div>-->
              	<br>
              <a href="post.php?post_id=<?php echo $id;?>" style="text-decoration:none;color:black;"><p class="font-weight-normal text-uppercase" style="font-size:30px;"><?php echo $title; ?></p> </a>
              
              <p class="font-weight-normal"><?php echo substr($post_data,0,400)."....."; ?></p>
					
				
					<a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary">Read More</a>

              <?php
					}
		}
else 
	{
		echo "<center><h2>No Posts Available</h2></center>";
	}              
              ?>
              </div>
              </div> <!-- row-->
              
            
      
  </div>   
<!--IMAGES--> 
 <section class="jumbotron jumbotron-fluid bg-white">
        <div class="container" id="images" name="images">
        <span class="d-block p-2 bg-light text-dark rounded">
          <h1 class="jumbotron-heading text-center animated pulse" style="animation-duration:1s; animation-delay:0s; animation-iteration-count:infinite;">IMAGES</h1>
          </span>
        </div>
      
        <div class="container">

<!--<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/ghost.jpg" style="height:500px;width:500px;"alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/image1.jpg" style="height:500px;width:500px;"alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="" style="height:500px;width:500px;"alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->



<?php 
             $get_query="SELECT * FROM media ORDER BY id DESC LIMIT 3";
             $get_run=mysqli_query($connection,$get_query); 
             if(mysqli_num_rows($get_run)>0) 
             {
             	while($get_row=mysqli_fetch_array($get_run)) 
             	{
             		$get_image=$get_row['image'];
             
                			
    			?>
    			
    			

					<a href="media/<?php echo $get_image;?>" class="thumbnail"><img src="media/<?php echo $get_image;?>" alt="image" width="300px" height="250px" style="margin:25px"></a>
					
<?php 
						}
					}
             else 
             {
             	echo "<center><h2 style='color:red;'>No media available</h2></center>";
             }					
					?>
					    		
					    		
<br>
<br>
<a href="admin/image.php" class="btn btn-dark" style="align:center;margin:auto;margin-top:20px;">Gallery</a> 
</div>
</section> 

<!--VIDEO-->
 <!--<section class="jumbotron text-center">
        <div class="container" id="videos" name="videos">
          <h1 class="jumbotron-heading">Video</h1>
        </div>
        <div class="album py-5 bg-light">
        <div class="container">
<div class="embed-responsive embed-responsive-21by9">
  <iframe style="height:500px;width:1100px;float:left;"class="embed-responsive-item" autoplay="true" src="https://www.youtube.com/embed/f59dDEk57i0" allowfullscreen></iframe>
  <a href="#" class="btn btn-dark" style="align:center;margin:auto; margin-top:50px;">Videos</a>
  </div> 
  </div>
  </div>
  </section> -->
  
  <!--footer-->
 <span class="d-block p-2 bg-light text-dark rounded">
    <footer class=" text-center" id="about">
    <p><strong>Scribble Now</strong> is a unique platform which allows you to share your thoughts,feelings,opinions or experiences - an online journal or diary with a minimal following.<br>You can also add your Photographs and share it with the world.<br> So Express Yourself and Share Your Passion !</p>
      <h5><strong>Blog created by - Nishita,Steffi,Nadia</strong></h5>
      </p>
    </footer>
         </span>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="bootstrap/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="bootstrap/js/vendor/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>-->
  </body>
</html>
