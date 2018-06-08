<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" href="css/bootstrap.min%20-%20Copy.css">
	  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/animate.min.css">
	  <link rel="stylesheet" href="css/publicstyles%20-%20Copy.css">
	  <script src="js/jquery-3.2.1.min%20-%20Copy.js"></script>
	  <script src="js/bootstrap.min%20-%20Copy.js"></script>
	  
	                  <style>
		

nav ul li{
    float: right;
	font-family: Arial, Helvetica, sans-serif;
}
						  
.test {
    font-family: Arial, Helvetica, sans-serif;
}

	       </style> 


    <title>Hello, world!</title>
  </head>
  <body>
	  
<!--NAVIGATION-->
	 
<nav class="navbar navbar-expand-lg navbar-light navbar-dark ">
	 <div class="container">
		 <a href="#">
                        <img class="logo" src="images/logo-2.png" alt="logo">
                    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navbar-right" id="navbarTogglerDemo01">
	              
	<ul class="nav navbar-nav ml-auto navbar-right">
		<li class="nav-item"><a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
	  <li class="nav-item active"><a class="nav-link" href="Blog.php">Blog</a>
		  <li class="nav-item"><a class="nav-link" href="#">À Propos</a>
	 <li class="nav-item"><a class="nav-link" href="index.php#services">Programmes et Services</a>
	<li class="nav-item"><a class="nav-link" href="index.php#pricing">Services Payants</a>
			 <li class="nav-item"><a class="nav-link" href="http://institutguylacombe.ca/bibliotheque/">Bibliotheque</a>
				 <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a>

	</ul>
  </div>
 </div>
</nav>
	     <!----End  Navigation ---->

	  <!--Blog-->
	  
	  
	  
	  
<div class="container"> <!--container-->
	<div class="blog-header">
		<br>
		<br>
	<h1 class="text-capitalize">Bienvenue sur notre blog</h1>
		<br>
		<p class="lead">Vous pouvez suivre tous nos activites et donner vos opinions</p>
	</div>
	<div class="row">
	<div class="col-sm-8">
		<?php
		global $ConnectingDB;
		if(isset($_GET["SearchButton"])){
			$Search=$_GET["Search"];
			$ViewQuery="SELECT * FROM admin_panel 
			WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
			OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
		}else{
			
		$ViewQuery="SELECT * FROM admin_panel  ORDER BY datetime desc LIMIT 0,5";}
		$Execute=mysql_query($ViewQuery);
		while($DataRows=mysql_fetch_array($Execute)){
			$PostId=$DataRows["id"];
			$DateTime=$DataRows["datetime"];
			$Title=$DataRows["title"];
			$Category=$DataRows["category"];
			$Admin=$DataRows["author"];
			$Image=$DataRows["image"];
			$Post=$DataRows["post"];
		?>
		<div class=" blogpost thumbnail">
			<img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
			
			<div class="caption">
				
				<h1  id="heading"><span class="text-capitalize"><?php echo htmlentities($Title);?></span></h1>
				<p class="description">Category: <?php echo htmlentities($Category);?> Publication <?php echo htmlentities($DateTime);?></p>
				<p class="post"><?php if (strlen($Post)>150){$Post=substr($Post,0,150).'...';} echo $Post;?></p>
			</div>
			<a href="PostComplet.php? id=<?php echo $PostId; ?>"><span class="btn btn-info">
				 lire la suite
				</span></a>
			
		</div>
		<?php } ?>
		
		</div>
		
		<div class="col-sm-offset-1 col-sm-3">
			<div >
			<form action="Blog.php" class="navbar-form navbar-right form-inline">
		<div class="form-group float-left">
		<input type="text" class="form-control btn-block" placeholder="Search" name="Search" >
			<br>
		</div>
	         <button class="btn btn-outline-success my-2 my-sm-0" name="SearchButton">Rechercher</button>
			
		</form>
			</div>
		<h2>Test</h2>
		<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing eliblt
		, sed do eiusmod tempor incididunt ut labore et dolore magna
		aliqua. Ut enim ad minim veniam, quis nostrud exercitation ul
		lamco laboris nisi ut aliquip ex ea commodo consequat. Duis a
		ute irure dolor in reprehenderit in voluptate velit esse cill
		um dolore eu fugiat nulla pariatur. Excepteur sint occaecat c
		upidatat non proi
		dent, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		
	</div>
	
	
</div> <!--End container-->

	  
	  
	  
	  
	  <!--End Blog-->
	  
	   <!---- Footer ---->
 
 <div id="footer" class="footer">
     <div class="container">
         <div class="row">
             <div class="col-lg-4 col-md-4">
                 <h4 class="wow fadeInUp">Nous contacter aussi</h4>
                 <p><i class="fa fa-home" aria-hidden="true"></i> La Cité francophone – Bureau 114 8627 rue Marie-Anne-Gaboury Edmonton, AB T6C 3N1</p>
                 <p><i class="fa fa-envelope" aria-hidden="true"></i>info@iglf.ca</p>
                 <p><i class="fa fa-phone" aria-hidden="true"></i> 780 468-4882</p>
                 <p><i class="fa fa-globe" aria-hidden="true"></i> http://www.institutguylacombe.ca</p>
             </div>
             <div class="col-lg-4 col-md-4">
                 <h4>A propos de nous</h4>
                 <p><i class="fa fa-square-o" aria-hidden="true"></i>Qui sommes-nous</p>
                 <p><i class="fa fa-square-o" aria-hidden="true"></i>Politique</p>
                 <p><i class="fa fa-square-o" aria-hidden="true"></i>Terme et condition</p>
             </div>
             <div class="col-lg-4 col-md-4">
                 <h4>Rester en contact</h4>
                 <i class="social fa fa-facebook" aria-hidden="true"></i>
                 <i class="social fa fa-twitter" aria-hidden="true"></i>
                <i class="social fa fa-linkedin" aria-hidden="true"></i>
                <i class="social fa fa-pinterest" aria-hidden="true"></i>
                <i class="social fa fa-youtube" aria-hidden="true"></i>
                <i class="social fa fa-github" aria-hidden="true"></i><br>
                <input type="email" placeholder="Abonnez-vous"><button class="btn btn-success">Souscrire</button>
             </div>
         </div>
     </div>
 </div>
	  
	  <!--footer-->
	  

	  
	  
	  

		  
		  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	  <script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>