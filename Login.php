
<?php
if(isset($_POST["Submit"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Password=mysql_real_escape_string($_POST["Password"]);

if(empty($Username)||empty($Password)){
	$_SESSION["ErrorMessage"]="Veuillez remplir tous les champs";
	Redirect_to("Login.php");
	
}
else{
	$Found_Account=Login_Attempt($Username,$Password);
	$_SESSION["User_Id"]=$Found_Account["id"];
	$_SESSION["Username"]=$Found_Account["username"];
	if($Found_Account){
	$_SESSION["SuccessMessage"]="Bienvenue  {$_SESSION["Username"]} ";
	Redirect_to("Dashboard.php");
		
	}else{
		$_SESSION["ErrorMessage"]=" Nom d'utilisateur / Mot de passe Incorrect";
	Redirect_to("Login.php");
	}
	
}	
}	

	


?>

<!DOCTYPE>

<html>
	<head>
		<title>Log-in</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/animate.min.css">

		
		
		<link rel="stylesheet" href="css/adminstyles.css">
<style>
	.FieldInfo{
    color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}
body{
	background-color: #ffffff;
}

</style>
                
	</head>
	<body>
		<div style="height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-expand-lg navbar-light navbar-dark ">
	 <div class="container">
		 <a href="#">
                        <img class="logo" src="images/logo-2.png" alt="logo">
                    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	              
	<ul class="nav navbar-nav ml-auto">
		<li class="nav-item active"><a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
		<li class="nav-item"><a class="nav-link" href="Blog.php">Blog</a>
	  <li class="nav-item"><a class="nav-link" href="#">À Propos</a>
	 <li class="nav-item"><a class="nav-link" href="#">Programmes et Services</a>
	<li class="nav-item"><a class="nav-link" href="#">Services Payants</a>
			 <li class="nav-item"><a class="nav-link" href="#">Bibliotheque</a>
				 <li class="nav-item"><a class="nav-link" href="#">Contact</a>

	</ul>
  </div>
 </div>
</nav>
		
<div class="Line" style="height: 10px; background: #27aae1;"></div>
<div class="container-fluid">
<div class="row">
	
	<div class="col-sm-offset-4 col-sm-4">
		<br><br><br><br>
		<?php echo Message();
	      echo SuccessMessage();
	?>
	<h2>Se connecter</h2>
	
<div>
<form action="Login.php" method="post">
	<fieldset>
	<div class="form-group">
	<label for="Username"><span class="FieldInfo">UserName:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon"></span>
	<span class="glyphicon glyphicon-envelope text-primary"></span>
	
	<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
	</div>	
	</div>
	
	<div class="form-group">
	<label for="Password"><span class="FieldInfo">Password:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-lock text-primary"></span>
	</span>
	<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
	</div>
	</div>
	
	<br>
<input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
	</fieldset>
	<br>
</form>

	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->

	    
	</body>
</html>