<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
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
                <a class="nav-link active" href="dashboard.php">
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
			
            <h1 class="h2">Admin Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              
              </div>
           
            </div>
          </div>
           			<div class="col-sm-10">
						<div>
							<?php echo Message();
							       echo SuccessMessage();
							?>
							</div>
						</div>
						<div class="table-responsive">
				 <table class="table table-striped table-hover">
					 
					 <tr>
					 <th>No</th>
					 <th>Titre du Post</th>
					 <th>Date</th>
					 <th>Auteur</th>
					 <th>Banner</th>
					 <th>Categorie</th>
					 <th>Commentaires</th>
					 <th>Action</th>
					 <th>Details</th>
					 </tr>
					 <?php
					 $ConnectingDB;
					 $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc;";
					 $Execute=mysql_query($ViewQuery);
					 $SrNo=0;
					 while($DataRows=mysql_fetch_array($Execute)){
   				    	 $Id=$DataRows["id"];
						 $DateTime=$DataRows["datetime"];
						 $Title=$DataRows["title"];
						 $Category=$DataRows["category"];
						 $Admin=$DataRows["author"];
						 $Image=$DataRows["image"];
						 $Post=$DataRows["post"];
						 $SrNo++;
						 
						 ?>
                        <tr>
					 <td><?php echo $SrNo; ?></td>
					 <td style="color:#5e5eff;"><?php 
						 if(strlen($Title)>20){$Title=substr($Title,0,20).'..';}
						 echo $Title; 
						 ?></td>
					 <td><?php 
						 if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,11).'..';}
						 echo $DateTime; ?></td>
					 <td><?php
				     if(strlen($Admin)>10){$Admin=substr($Admin,0,10).'..';}
					 echo $Admin; ?></td>
					 <td><?php 
						 if(strlen($Category)>10){$Category=substr($Category,0,10).'..';}
						 echo $Category; ?></td>
					 <td><img src="Upload/<?php echo $Image; ?>" width="120px"; height="60px"></td>
					 <td>
						 
<?php
$ConnectingDB;
$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteApproved=mysql_query($QueryApproved);
$RowsApproved=mysql_fetch_array($ExecuteApproved);
$TotalApproved=array_shift($RowsApproved);
if($TotalApproved>0){
?>
<span class="badge  badge-pill badge-success float-right">
<?php echo $TotalApproved;?>
</span>
		
<?php } ?>

<?php
$ConnectingDB;
$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
$ExecuteUnApproved=mysql_query($QueryUnApproved);
$RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
$TotalUnApproved=array_shift($RowsUnApproved);
if($TotalUnApproved>0){
?>
<span class="badge float-left  badge-pill  badge-danger">
<?php echo $TotalUnApproved;?>
</span>
		
<?php } ?>
							
					</td>
					 <td>
						<a href="EditerPost.php?Editer=<?php echo $Id; ?>"> 
						<span class="btn btn-warning">Editer </span></a>
						<a href="EliminerPost.php?Eliminer=<?php echo $Id; ?>"> 
							<span class="btn btn-danger">Eliminer</span> </a>
							</td>
					 <td><a href="PostComplet.php?id=<?php echo $Id; ?>"target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
					 
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
