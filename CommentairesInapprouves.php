<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $ConnectingDB;
   
$Query="UPDATE comments SET status='OFF' WHERE id='$IdFromURL' ";
$Execute=mysql_query($Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Votre commentaire a ete desapprouve avec success";
	Redirect_to("Commentaires.php");
	}else{
	$_SESSION["ErrorMessage"]="Il y a eu un probleme, essayez de nouveau.";
	Redirect_to("Commentaires.php");
		
	}
    
    
    
    
    
}

?>