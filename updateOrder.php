<?php

    include("connection.php");
    //get logged in user
    $user = "ghelpo";
    $user_id = 1;
    $queryrec=" SELECT `id`, `num`, `subject`, `status` FROM `sentorder`" ;
    $resultrec = mysqli_query($link,$queryrec);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ماسبيرو</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <h2 class="txt text-center">تحديث حالة الخطاب</h2>
            <br><hr>
            <form id="ord-form" method="post" enctype="multipart/form-data" class="txt form-horizontal" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="reqo-id-up">الرقم المسلسل للخطاب و الموضوع</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="reqo-id-up" required>
                            <option disabled selected value=""> -- برجاء الاختيار اولا -- </option>
                             <?
                                while($rowrec = mysqli_fetch_array($resultrec))
                                {
                                    echo'<option id = '.$rowrec['id'].' value='.$rowrec['status'].'> '.$rowrec['num'].'-'.$rowrec['subject'].' </option>';
                                }
                            ?>

                        </select>
                    </div>
                </div>
               <div class="form-group">
                    <label class="control-label col-sm-2" for="cur-ostat">الحالة السابقة</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cur-ostat" placeholder="الحالة الحالية" name="" value="" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nostat">الحالة الحالية</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nostat" placeholder="الحالة الحالية" name="res">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="up-ostat">تحديث</button>
                    </div>
                </div>
            </form>
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
