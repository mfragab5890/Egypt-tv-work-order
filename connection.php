<?php
$host = "85.10.205.173:3306";
$user='ghelpo';
$pass='tafiTAFI';
$databasename='ghelpo';

date_default_timezone_set("Africa/Cairo");




   $link = mysqli_connect($host, $user, $pass, $databasename);

        if (!$link) {

            die ("Database Connection Error");

        }

?>
