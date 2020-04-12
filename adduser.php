<?php

//session_start();
//$diaryContent="";
include("connection.php");

$username = "ghelpo";
$data["file"] = "opened";

if(isset($_POST['Uname'])){
    if(isset($_POST['pass'])){
        $data['name'] = $_POST['Uname'];
        $data['pass'] = md5(md5(mysqli_insert_id($link)).$_POST['pass']);

        $queryuse=" SELECT * FROM `users` WHERE `email` = '".$_POST['Uname']."'" ;	
        $resultuse = mysqli_query($link,$queryuse);

        if(!$rowuse = mysqli_fetch_array($resultuse))
        {
            $query ="INSERT INTO `users` (
            `id`, 
            `email`, 
            `password`, 
            `level`, 
            `loggedin`) 
            VALUES (
            NULL, 
            '".$_POST['Uname']."', 
            '".$data['pass']."', 
            '1', 
            '1')";  

            if(mysqli_query($link, $query))  
            {  
                $data["sucsess"] = 1;  

            }
            else 
            {
                $data["sucsess"] = 2;
            } 
        }
        else
        {
            $data["sucsess"] = 0;

        }    
    }
    
}


echo json_encode($data);



?>


