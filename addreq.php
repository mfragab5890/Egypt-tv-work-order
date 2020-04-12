<?php

//session_start();
//$diaryContent="";
include("connection.php");
$error = "";  
$data["file"] = "opened"; 

if(isset($_POST['crb']))
{
    if(isset($_POST['cro']))
    {
        if(isset($_POST['num']))
        {
            if(isset($_POST['rto']))
            {
                if(isset($_POST['subj']))
                {
                    if(isset($_POST['stat']))
                    {
                        if(isset($_POST['rfrm']))
                        {
                            
                            $data['id'] = $_POST['crb'];
                            $data['date'] = $_POST['cro'];
                            $data['num'] = $_POST['num'];
                            $data['sntto'] = $_POST['rto'];
                            $data['subj'] = $_POST['subj'];
                            $data['status'] = $_POST['stat'];
                            if(isset($_POST['cmnt']))
                            {
                                $data['note'] = $_POST['cmnt'];
                            }
                            else
                            {
                                $data['note'] = "none";
                            }

                            $data['id'] = $_POST['crb'];
                            $data['date'] = $_POST['cro'];
                            $data['num'] = $_POST['num'];
                            $data['sntto'] = $_POST['rto'];
                            $data['subj'] = $_POST['subj'];
                            $data['rfrom'] = $_POST['rfrm'];
                            $data['status'] = $_POST['stat'];
                            $data['note'] = $_POST['cmnt'];

                            $query = "INSERT INTO `recvorder` (                            
                                `id`, 
                                `created_by`, 
                                `created_on`, 
                                `date`, 
                                `num`, 
                                `sent_to`, 
                                `subject`, 
                                `rec_from`, 
                                `status`, 
                                `notes`)  
                                VALUES (
                                NULL, 
                                '".$data['id']."', 
                                '".date("Y-m-d H:i:s")."', 
                                '".$data['date']."', 
                                '".$data['num']."', 
                                '".$data['sntto']."', 
                                '".$data['subj']."', 
                                '".$data['rfrom']."', 
                                '".$data['status']."', 
                                '".$data['note']."')";  

                                if(mysqli_query($link, $query))  
                                {  
                                    $data["sucsess"] = 1;  

                                }
                                else 
                                {
                                    $data["sucsess"] = 0;
                                } 


                            }
                        }
                    }
                }
            }
        }
    }



//images convert
/*
$file_name = $key.$_FILES['image']['name'][$key];
	$file_size =$_FILES['image']['size'][$key];
	$file_tmp =$_FILES['image']['tmp_name'][$key];
	$file_type=$_FILES['image']['type'][$key];	
        if($file_size > 2097152){
          $errors[]='File size must be less than 2 MB';
        }
    $file = addslashes(file_get_contents($file_tmp)); 

$data['oimg'] = $_FILES['oimg'];
$data['oatt'] = $_FILES['aimg'];*/
 

echo json_encode($data);


?>






