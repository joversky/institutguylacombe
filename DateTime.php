<?php
date_default_timezone_set("America/Edmonton");
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
$CurrentTime=time();
$DateTime=strftime("%d %B %Y, %H:%M:%S", $CurrentTime); 
echo $DateTime
?>