<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Title=mysql_real_escape_string($_POST["Title"]);
$Category=mysql_real_escape_string($_POST["Category"]);
$Post=mysql_real_escape_string($_POST["Post"]);
date_default_timezone_set("America/Edmonton");
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
$CurrentTime=time();
$DateTime=strftime("%d %B %Y, %H:%M:%S", $CurrentTime); 
$DateTime;
$Admin=$_SESSION["Username"];
$Image=$_FILES["Image"]["name"];
$Target="Upload/".basename($_FILES["Image"]["name"]);
if(empty($Title)){
	$_SESSION["ErrorMessage"]="Title can't be empty";
	Redirect_to("Publier.php");
	
}elseif(strlen($Title)<2){
	$_SESSION["ErrorMessage"]="Title Should be at-least 2 Characters";
	Redirect_to("Publier.php");
	
}else{
	global $ConnectingDB;
	$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post)
	VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
	$Execute=mysql_query($Query);
	move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
	if($Execute){
	$_SESSION["SuccessMessage"]="Post Added Successfully";
	Redirect_to("Publier.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("Publier.php");
		
	}
	
}	
	
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Dashboard Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
	  
	  <style>
	.FieldInfo{
    color: black;
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}

</style>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">IGLF Panel</a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="Logout.php">Déconnexion</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
       
		  
		          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                   <span data-feather="home"></span>
                  &nbsp;Dashboard <span class="home"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="Publier.php">
                  <span data-feather="file"></span>
                  &nbsp;Ajouter un poste
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="categories.php">
                <span data-feather="server"></span>
                  &nbsp;Categories
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Admins.php">
                  <span data-feather="settings"></span>
                  &nbsp;Administration
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Commentaires.php">
                  <span data-feather="message-square"></span>
                  &nbsp;Commentaires
					
				<?php
$ConnectingDB;
$QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
$ExecuteTotal=mysql_query($QueryTotal);
$RowsTotal=mysql_fetch_array($ExecuteTotal);
$Total=array_shift($RowsTotal);
if($Total>0){
?>
<span class="badge badge-pill badge-warning">
<?php echo $Total;?>
</span>
		
<?php } ?>	
					
					
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Blog.php">
                  <span data-feather="layers"></span>
                  Live Blog
                </a>
              </li>
				
				 <li class="nav-item">
                <a class="nav-link" href="Logout.php">
                  <span data-feather="log-out"></span>
                  Déconnexion
                </a>
              </li>
            </ul>
          </div>
        </nav>
		  
		  
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Publication de videos</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
               
              </div>
              
            </div>
          </div>
           	<div class="col-sm-10">
				<div>
							<?php 
					          echo Message();
							  echo SuccessMessage();
							?>
						</div>
				
				
				<form action="Publier.php" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="categoryname"><span class="FieldInfo">Titre:</span></label>
						<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
							</div>
						
						<div class="form-group">
	<label for="categoryselect"><span class="FieldInfo">Catégorie:</span></label>
	<select class="form-control" id="categoryselect" name="Category" >
	<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysql_query($ViewQuery);
while($DataRows=mysql_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$CategoryName=$DataRows["name"];
?>	
	<option><?php echo $CategoryName; ?></option>
	<?php } ?>
			
	</select>
	</div>

							<div class="form-group">
							<label for="categoryname"><span class="FieldInfo">Liens du video:</span></label>
						<input class="form-control" type="text" name="Videolink" id="videolink" placeholder="...">
							</div>					
						
						
	<div class="form-group">
	<label for="postarea"><span class="FieldInfo">
Publication:</span></label>
	<textarea class="form-control" name="Post" id="postarea"></textarea>
						<br>
						<input class="btn btn-info" type="Submit" name="Submit" value="Ajouter un poste">
					</fieldset>
					<br>
				</form>
				
					</div>
			
			<!---Table starts here-->
			
							<div>
				

<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysql_query($ViewQuery);
$SrNo=0;
while($DataRows=mysql_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$CategoryName=$DataRows["name"];
	$CreatorName=$DataRows["creatorname"];
	$SrNo++;
}

?>
			</div>
          <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
        </main>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  </body>
</html>
