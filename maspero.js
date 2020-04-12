/*
ordsub submit order
recsub submit request
natsub new attachment
nentsub new entity
nressub new user
up-ostat update order status
up-rstat update request status
*/




$(document).ready(function () {
    //table scroll
    $('#dtDynamicVerticalScrollExample').DataTable({
    "scrollY": "50vh",
    "scrollCollapse": true,
    });
    $('.dataTables_length').addClass('bs-select');
    //resize for mobile
    var holdWidth = $(window).width();
    $(window).on('resize', function () {
        newPercentage = (($(window).width() / holdWidth) * 100) + "%";
        $("html").css("font-size", newPercentage)
    });
});


// check for connected order
function checkFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("recv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
      document.getElementById("req-sel").required = true;
      text.style.display = "block";
  } else {
      document.getElementById("req-sel").required = false;
      text.style.display = "none";
      $("#req-sel").val("");
  }
}

//submit sent order.
$( "#ordsub" ).click(function() 
{
    if ($("#send-form").valid()) 
    {
        var crb = $("#sres").val();
        var cro = $("#date").val();
        var num = $("#ord-id").val();
        var rto = $("#sent").val();    
        var oimg = $("#order-img").val();
        var aimg = $("#order-att").val();
        var subj = $("#subj").val();
        var rfrm = $("#req-sel").children(":selected").val();
        var stat = $("#status").val();
        var cmnt = $("#cmnt").val();
        if(cmnt == "")
        {
            cmnt="لايوجد";
        }
            
            $.ajax({
                url:"addord.php",
                method:"POST",
                data:{
                    
                    crb : crb,
                    cro : cro,
                    num : num,
                    rfrm : rfrm,
                    oimg : oimg,
                    aimg : aimg, 
                    subj : subj,
                    rto : rto,
                    stat : stat,
                    cmnt : cmnt
                },
                dataType:"JSON",
                success:function(data)
                { 
                    if(data["sucsess"]==0)
                    {
                        alert("فشل التسجيل يجب ملئ البيانات المطلوبة");
                    }
                    else if(data["sucsess"]==1)
                    {
                        alert("تم التسجيل بنجاح"); 
                        location.href='viewOrder.php';
                    }
                   alert(JSON.stringify(data));   
                }
            })
    }                 
    
});

//submit requested order.
$( "#recsub" ).click(function() 
{
    if ($("#rec-form").valid()) 
    {
        var crb = $("#rres").val();
        var cro = $("#date-rec").val();
        var num = $("#rec-id").val();
        var rfrm = $("#rec-ent").val();
        var oimg = $("#rec-order-img").val();
        var aimg = $("#rec-order-att").val();
        var subj = $("#rec-subj").val();
        var rto = $("#to-ent").val();
        var stat = $("#rec-stat").val();
        var cmnt = $("#rec-cmnt").val();
        if(cmnt == ""){
                cmnt="لايوجد";
            }
        alert(cmnt);
        $.ajax({
            url:"addreq.php",
            method:"POST",
            data:{

                crb : crb,
                cro : cro,
                num : num,
                rfrm : rfrm,
                oimg : oimg,
                aimg : aimg, 
                subj : subj,
                rto : rto,
                stat : stat,
                cmnt : cmnt
            },
            dataType:"JSON",
            success:function(data)
            { 
                if(data["sucsess"]==0)
                {
                    alert("فشل التسجيل يجب ملئ البيانات المطلوبة");
                }
                else if(data["sucsess"]==1)
                {
                    alert("تم التسجيل بنجاح"); 
                    location.href='viewRequest.php';
                }
               // alert(JSON.stringify(data));   
            }
        })
    }
    
});


//Add Entity
$( "#nentsub" ).click(function() 
{
    if ($("#ent-form").valid()) 
    {
        var Ename = document.getElementById("new-ent").value;
        if(Ename == "")
        {
            alert("ارجو كتابة اسم الجهة");
        }
        else
        {
            $.ajax({
                url:"addentity.php",
                method:"POST",
                data:{

                    Ename:Ename
                },
                dataType:"JSON",
                success:function(data)
                { 
                    if(data["update"]==1)                
                    {
                        alert("تم اضافة الجهة الجديدة بنجاح");
                        location.reload();  
                    }
                    else if(data["update"]==0)                
                    {
                        alert("تعذر التسجيل ارجو المحاولة لاحقا");

                    }
                    else if(data["update"]==3)                
                    {
                        alert("الجهة مسجلة بالفعل ارجو اختيار اسم جديد");

                    }
                    //alert(JSON.stringify(data));   
                }
            })

        }
    }
});

//add new user
//password confirm 
var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("كلمتان السر غير متطابقين");
  } else {
    confirm_password.setCustomValidity('');
  }
}


if(password != null){
    password.onchange = validatePassword;
}
if (confirm_password != null){
    confirm_password.onkeyup = validatePassword;

}

$( "#nressub" ).click(function() 
{
    var Uname = document.getElementById("new-res").value;
    var pass = document.getElementById("password").value;
    var con_pass= document.getElementById("confirm_password").value;
    if ($("#user-form").valid()) 
    {
        if(Uname == "")
        {
            alert("ارجو كتابة اسم المستخدم");
        }
        else if((pass == "") || (con_pass == ""))
        {

            alert("ارجو كتابة كلمة السر و تاكيدها");          
        }
        else if(pass == con_pass)
        {
             $.ajax({
              url:"adduser.php",
              method:"POST",
              data:{

                  Uname:Uname,
                  pass:pass
              },
              dataType:"JSON",
              success:function(data)
              { 
                  if(data["sucsess"]==0)
                  {
                      alert("الاسم مسجل بالفعل ارجو اختيار اسم جديد");
                  }
                  else if(data["sucsess"]==1)
                  {
                      alert("تم التسجيل بنجاح"); 
                      location.reload();  
                  }
                  else if(data["sucsess"]==2)
                  {
                      alert("تعذر التسجيل ارجو المحاولة لاحقا"); 
                  }
              }
          })    
        }
    }
});

//update order status
//get old status
$('#reqo-id-up').on('change', function() {
    var opt = this.value;
    $('#cur-ostat').val(opt)    
    var id = $(this).children(":selected").attr('id'); 
    $('#nostat').attr('name', id);

});

$( "#up-ostat" ).click(function() 
{
    if ($("#ord-form").valid()) 
    {
        var Ename = $('#nostat').val();
        var id = $('#nostat').attr('name');

        if(Ename == "")
        {
            alert("ارجو كتابة الحالة الجديدة");
        }
        else
        {
            $.ajax({
                url:"addostat.php",
                method:"POST",
                data:{

                    Ename:Ename,
                    id:id
                },
                dataType:"JSON",
                success:function(data)
                { 
                    if(data["update"]==1)
                  {
                      alert("تم التحديث بنجاح");
                      location.href='viewOrder.php';  
                  }
                    else if(data["update"]==0)
                  {
                      alert("تعذر التحديث ارجو المحاولة لاحقا"); 
                        
                  }
                    //alert(JSON.stringify(data));   
                }
            })

        }
    }
});

//update request status
//get old status
$('#reqr-id-up').on('change', function() {
    var opt = this.value;
    var id = $(this).children(":selected").attr('id');
    $('#cur-rstat').val(opt);
    $('#nrstat').attr('name', id);
    
});

$( "#up-rstat" ).click(function() 
{
    if ($("#req-form").valid()) 
    {
        var Ename = $('#nrstat').val();
        var id = $('#nrstat').attr('name');
        if(Ename == "")
        {
            alert("ارجو كتابة الحالة الجديدة");
        }
        else
        {
            $.ajax({
                url:"addrstat.php",
                method:"POST",
                data:{

                    Ename:Ename,
                    id:id
                },
                dataType:"JSON",
                success:function(data)
                { 
                    if(data["update"]==1)
                  {
                      alert("تم التحديث بنجاح");
                      location.href='viewRequest.php';
                  }
                    else if(data["update"]==0)
                  {
                      alert("تعذر التحديث ارجو المحاولة لاحقا"); 
                  }
                    //alert(JSON.stringify(data));   
                }
            })

        }
    }
});