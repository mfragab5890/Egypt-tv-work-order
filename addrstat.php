<?php

//session_start();
//$diaryContent="";
include("connection.php");
$username = "ghelpo";
$data["update"] = 10;
if (isset($_POST['Ename']))   
{
    if (isset($_POST['id']))
    {
        $data['status'] = $_POST['Ename'];
        $data['id'] = $_POST['id'];

        $queryupdate="UPDATE `recvorder` SET `status` = '".$_POST['Ename']."' WHERE `id` = '".$_POST['id']."' "; 

        if(mysqli_query($link, $queryupdate))  
        {  
            $data["update"] = 1;  

        }
        else 
        {
            $data["error"] = 0;
        } 
    }
}
echo json_encode($data);



?>


