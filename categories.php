<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Category=mysql_real_escape_string($_POST["Category"]);
date_default_timezone_set("America/Edmonton");
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
$CurrentTime=time();
$DateTime=strftime("%d %B %Y, %H:%M:%S", $CurrentTime); 
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Category)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("categories.php");
	
}elseif(strlen($Category)>99){
	$_SESSION["ErrorMessage"]="Too long Name for Category";
	Redirect_to("categories.php");
	
}else{
	global $ConnectingDB;
	$Query="INSERT INTO category(datetime,name,creatorname)
	VALUES('$DateTime','$Category','$Admin')";
	$Execute=mysql_query($Query);
	if($Execute){
	$_SESSION["SuccessMessage"]="Category Added Successfully";
	Redirect_to("categories.php");
	}else{
	$_SESSION["ErrorMessage"]="Category failed to Add";
	Redirect_to("categories.php");
		
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
                <a class="nav-link" href="Publier.php">
                  <span data-feather="file"></span>
                  &nbsp;Ajouter un poste
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="categories.php">
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
            <h1 class="h2">Categorie</h1>
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
				<form action="categories.php" method="post">
					<fieldset>
						<div class="form-group">
							<label for="categoryname"><span class="FieldInfo">Name:</span></label>
						<input class="form-control" type="text" name="Category" value="" id="categoryname" placeholder="Name">
							</div>
						<br>
						<input class="btn btn-info" type="Submit" name="Submit" value="Add New Category">
					</fieldset>
					<br>
				</form>
				
			</div>
			
			<!---Table starts here-->
			
							<div class="table-responsive">
				
					<table class="table table-striped table-hover">
	<tr>
		<th>Sr No.</th>
		<th>Date & Time</th>
		<th>Category Name</th>
		<th>Creator Name</th>
		<th>Action</th>
		
	</tr>
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

?>
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	<td><?php echo $CategoryName; ?></td>
	<td><?php echo $CreatorName; ?></td>
	<td><a href="EliminerCategories.php?id=<?php echo $Id;?>">
	<span class="btn btn-danger">Delete</span>
	</a></td>
	
</tr>
		
	<?php } ?>	
						
					</table>
					
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
