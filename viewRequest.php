<?php

    include("connection.php");
    //get logged in user
    $user = "ghelpo";
    $user_id = 1;
    //get current orders
    $queryrec=" SELECT * FROM `recvorder`" ;	
    $resultrec = mysqli_query($link,$queryrec);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ماسبيرو</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="lib/all.css">
        <!-- Bootstrap core CSS -->
        <link href="lib/css/bootstrap.min.css" rel="stylesheet">
        <!-- MDBootstrap Datatables  -->
        <link href="lib/css/addons/datatables.min.css" rel="stylesheet">
        <link href="lib/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- custom CSS -->
        <link rel="stylesheet" type="text/css" href="maspero.css">
    </head>
    
    <body>

            <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <img src="maspero-icon.jpg" width="45" height="45">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">الصفحة الرئيسية</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        الذهاب الى-->
                    </a>
                    <div class="dropdown-menu" style="font-size:8px; padding:20px;">
                        <div class="row">
                            <div class="col-sm-4">
                                <div height="50">
                                    <a href="sendOrder.php">
                                        <img width="30" height="30" src="sent.jpg"> امر شغل  صادر
                                    </a>
                                    <br><hr>
                                </div>
                                <div height="50">
                                    <a href="receivedOrder.php">
                                        <img width="30" height="30" src="inbox.jpg"> امر شغل  وارد
                                    </a>
                                    <br><hr>
                                </div>
                                <div height="50">
                                    <a href="newEntity.php">
                                        <img width="30" height="30" src="sent.jpg"> جهات عمل جديدة
                                    </a>
                                    <br><hr>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div height="50">
                                    <a href="newUser.php">
                                        <img width="30" height="30" src="inbox.jpg"> مسؤول تسجيل
                                    </a>
                                    <br><hr>
                                </div>
                                <div height="50">
                                    <a href="viewOrder.php">
                                        <img width="30" height="30" src="showSent.jpg"> بريد صادر
                                    </a>
                                    <br><hr>
                                </div>
                                <div height="50">
                                    <a href="viewRequest.php">
                                        <img width="30" height="30" src="received.jpg"> بريد وارد
                                    </a>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div height="50">
                                    <a href="updateOrder.php">
                                        <img width="30" height="30" src="sentStatus.jpg"> حالة بريد صادر
                                    </a>
                                    <br><hr>
                                </div>
                                <div height="50">
                                    <a href="updateRequest.php">
                                        <img width="30" height="30" src="receivedStatus.jpg"> حالة بريد وارد
                                    </a>
                                    <hr>
                                </div>
                                <div height="50">
                                    <a href="addAttachment.php">
                                        <img width="30" height="30" src="addAttach.jpg"> اضافة مرفقات
                                    </a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </li>
            </ul>
        </nav>
        <hr>
        <br>
        <br>
        <div class="jumbotron bg-wyt">
            
            <img src="maspero.jpg" width="175" height="140">
            
            <div style="float:right;">
                <h4>اتحاد الإذاعة و التليفزيون</h1>
                <hr>
                <h5>قطاع الهندسة الإذاعية</h2>
                <hr>
                <h6>إدارة المحفوظات</h3>
                <hr>
            </div>
            <br>
        </div>

        <div class="container">
            <h2 class="txt text-center">بريد وارد</h2>
            <br><hr>
            <div class="bg-wyt">
                <table id="dtDynamicVerticalScrollExample" class="table table-striped table-bordered table-dark table-sm" cellspacing="0" >
                    <thead>
                        <tr>
                            <th class="th-sm">#</th>
                            <th class="th-sm">رقم مسلسل</th>
                            <th class="th-sm">مرفقات</th>
                            <th class="th-sm">الجهة الصادر اليها</th>
                            <th class="th-sm">الموضوع</th>
                            <th class="th-sm">الجهة الوارد منها</th>
                            <th class="th-sm">حالة الطلب</th>
                            <th class="th-sm">تاريخ</th>
                            <th class="th-sm">الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?
                            while($rowrec = mysqli_fetch_array($resultrec))
                            {
                                //get sent to entity
                                $queryent="SELECT `name` FROM `entity` WHERE `id` = '".$rowrec['sent_to']."' LIMIT 1 " ;	
                                $resultent = mysqli_query($link,$queryent);
                                $rowoent = mysqli_fetch_array($resultent);
                                //get sender entity
                                $queryent="SELECT `name` FROM `entity` WHERE `id` = '".$rowrec['rec_from']."' LIMIT 1 " ;	
                                $resultent = mysqli_query($link,$queryent);
                                $rowoentt = mysqli_fetch_array($resultent);
                                //fill table data
                                echo'
                                <tr>
                                <td>'.$rowrec['id'].'</td>
                                <td>'.$rowrec['num'].'</td>
                                <td>"attachment reserved"</td>
                                <td>'.$rowoent['name'].'</td>
                                <td>'.$rowrec['subject'].'</td>
                                <td>'.$rowoentt['name'].'</td>
                                <td>'.$rowrec['status'].'</td>
                                <td>'.$rowrec['date'].'</td>
                                <td>'.$rowrec['notes'].'</td>
                                </tr>
                                ';
                            }

                        ?>
                    </tbody>
                </table>    
            </div>
        </div>
        
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="lib/js/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="lib/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
        <!-- datatables JavaScript -->
        <script type="text/javascript" src="lib/js/addons/datatables.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="lib/js/mdb.min.js"></script>
        <!-- form-validation -->
        <script src="lib/jquery.validate.min.js"></script>
        <script src="lib/additional-methods.min.js"></script>
        <!-- custom javascript -->
        <script src="maspero.js"></script> 
    
    </body>

</html>