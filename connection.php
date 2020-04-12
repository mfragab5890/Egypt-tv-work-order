<?php

include("databasedetails.php"); 
  
   $link = mysqli_connect("localhost", $user, $pass, $databasename);
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }

?>