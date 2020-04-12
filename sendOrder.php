<?php

    include("connection.php");
    //get logged in user
    $user = "ghelpo";
    $user_id = 1;
    //get current entities
    $queryent=" SELECT `id`, `name` FROM `entity`" ;	
    $resultent = mysqli_query($link,$queryent);
    //get current requests
    $queryreq=" SELECT `id`, `num`, `rec_from` FROM `recvorder` " ;	
    $resultreq = mysqli_query($link,$queryreq);
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
            
            <img src="maspero.jpg" width="175" height="140" id="mas-img">
            
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
            <h2 class="txt">امر شغل صادر</h2>
            <form id="send-form" method="post" enctype="multipart/form-data" class="txt form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sres">اسم القائم بالتسجيل</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sres" placeholder="اسم القائم بالتسجيل" name="<? echo "$user_id" ; ?>" value="<? echo "$user" ; ?>" readonly required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date"> تاريخ الطلب</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" placeholder="ادخل تاريخ الطلب" name="date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="ord-id">الرقم المسلسل</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ord-id" placeholder="رقم مسلسل" name="res" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sent">الجهة الصادر اليها</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sent" required>
                            <option disabled selected value=""> -- برجاء الاختيار اولا -- </option>
                            <?
                                while($rowent = mysqli_fetch_array($resultent))
                                {
                                    echo'<option value='.$rowent['id'].'> '.$rowent['id'].'-'.$rowent['name'].' </option>';
                                }      
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="order_img">صورة المحضر</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" id="order_img" accept="image/*" name="اختار ملف" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="order_att">مرفقات اخرى</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" id="order_att">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="subj">الموضوع</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="subj" rows="5" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <label class="checkbox-inline"><input type="checkbox" value="" id="myCheck" onclick="checkFunction()"> مرتبط بخطاب وارد؟ </label>
                    </div>
                </div>
                <div class="form-group" style="display:none;" id="recv">
                    <label class="control-label col-sm-2" for="recv">رقم الخطاب الوارد</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="req-sel" >
                            <option disabled selected value="0"> -- برجاء الاختيار اولا -- </option>
                            <?
                                while($rowreq = mysqli_fetch_array($resultreq))
                                {
                                    echo'<option value='.$rowreq['id'].'> رقم '.$rowreq['num'].'-'.$rowreq['rec_from'].' صادر من</option>';
                                }      
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="status">حالة الطلب</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="status" placeholder="حالة الطلب" name="stat" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cmnt">ملاحظات اخرى</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="cmnt" rows="2"></textarea>
                    </div>
                </div>
               
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="ordsub">ارسال</button>
                    </div>
                </div>
            </form>
        </div>
        
        <footer class="page-footer font-small cyan darken-3">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://karezma.co/"> karezma.co</a>
            </div>
            <!-- Copyright -->

        </footer>
    
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