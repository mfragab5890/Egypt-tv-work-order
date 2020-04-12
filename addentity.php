<?php

//session_start();
//$diaryContent="";
include("connection.php");

$username = "ghelpo";
$data["file"] = "opened";
$queryent=" SELECT `name` FROM `entity` WHERE `name` = '".$_POST['Ename']."' " ;	
$resultent = mysqli_query($link,$queryent);
if (isset($_POST['Ename']))
{
    if(!$rowent = mysqli_fetch_array($resultent))   
    {
        $data['name'] = $_POST['Ename'];

        $query ="INSERT INTO `entity`(
            `id`, 
            `created_by`, 
            `created_on`, 
            `name`
            ) 
            VALUES (
            NULL,
            '".$username."',
            '".date("Y-m-d H:i:s")."',
            '".$_POST['Ename']."'
            )";  

        if(mysqli_query($link, $query))  
        {  
            $data["update"] = 1;  

        }
        else 
        {
            $data["update"] = 0;
        } 
    }
    else
    {
        $data["update"] = 3;   
    }
}

echo json_encode($data);



?>


