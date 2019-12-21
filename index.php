<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>訂便當</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    body{
      background-image: url(img/mel-cFIZ6TBJT-Y-unsplash.jpg);
      background-position: center center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      -webkit-background-size: cover;
      background-size: cover;
      
    }
    #btn{
      position: fixed;
      top: 50px;
      left: 20px;
      background-color: rgba(200,0,0,0.4);
      border-radius: 5%;
      padding: 10px;
    }
  </style>
</head>
  <body>
    <div></div>

<!--Navbar -->
<section>
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
    <a class="navbar-brand" href="index.php"><i class="fas fa-utensils">    訂便當</i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">店家資料維護
          </a>
          <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
            <a class="dropdown-item" href="addstore.php">新增店家資料</a>
            <a class="dropdown-item" href="edit_store.php">修改、刪除店家</a>
          </div>
        </li>
      </ul>
      
    </div>
  </nav>
</section>


<section>
  <div class="container mt-3  rgba-red-slight p-3"  style="position:relative;" id="ct1">





  </div>
  <div class="container">
    <div class="row">
      <!-- Central Modal Small -->
      <div class="modal fade" id="centralModalLg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="mybd">Modal title</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              請選擇座號<br>
              <div class=" d-flex flex-wrap" id="md_body">
                
              </div> 
            </div>
            <div class="modal-footer d-flex flex-column flex-md-row ">
              <h3><div class="badge badge-info " id="order_user"></div></h3>
              <button type="button"  class="btn btn-primary btn-sm " id="order_bd" data-dismiss="modal">確認訂餐</button>
              <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">取陗</button>
            </div>
          </div>
        </div>
      </div>    
      <!-- Central Modal Small -->  


    </div>
  </div>  

</section>
  <div class="container">
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;min-width: 400px;"><div class="toast" style="position: fixed; top:50px; right:10px;" data-autohide="true" data-delay="6000"><div class="toast-header"><svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect fill="red" width="100%" height="100%" / id="rect"></svg><strong class="mr-auto">取消訂餐</strong><small></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="false">&times;</span></button></div><div class="toast-body" >取消訂餐成功!!<br>如有需要，請重新訂餐!!</div></div></div>
  </div>

     




    <!-- Optional JavaScript -->
    <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script>

      // 取得今天日期，做為oreder_name
      var dt = new Date();
      var $today = dt.getFullYear() +'-'+ (dt.getMonth()+1) +'-'+ dt.getDate();
      var toast_str1,toast_str2;            //notif
      var $uname;     //姓名
      //確認訂單是否產生
      $(function(){
         $.ajax({
            url:"check_order_api.php",
            type:"post",
            data:{today:$today},
            success:show,
            error:function(){
                alert("check order api error!");
            }
         }); 
      });
      function show(data){
        if(data){
            //訂單已產生,show出訂單
            $.ajax({
                url:"torder_api.php",
                type:"post",
                data:{today:$today},
                dataType:"json",
                success:get_orderlist,
                error:function(){
                    alert("Get list Error!!")
                }
            });        
         } else {
            //訂單不存在
            alert("今天值日生尚未選擇店家")
            $("#ct1").append('<h1>值日生尚未選擇店家,<br>請值日生<a href="select_store.php?today=' + $today + '">選擇店家</a></h1>"');
         }
      }
      //show訂單
      function get_orderlist(data){
            $("#ct1").html(" ");
            $("#ct1").append('<div class="row"><div class="col-lg-7 border border-primary"></div><div class="col-lg-5"></div></div>');
            $(".col-lg-7").append('<tbody>');
            $(".col-lg-7").html(" ");
            $(".col-lg-7").append('<h1 class = "text-primary">今天訂<span class="badge badge-primary">' + data[0].store_name +'</span></h1>' );
            $(".col-lg-7").append('<h1 class = "text-primary">值日生：<span class="badge badge-secondary" id=owner></span>號</h1>' );
            $(".col-lg-7").append('<table class="table table-striped table-responsive-md btn-table " ><thead><tr class = "text-primary"><th><h5>#</h5></th><th><h5>餐點</h4></th><th><h5>價錢</h5></th></tr></thead><tbody id="tb_tc"></tbody></table>');
            num = 1;
            for(var i = 4; i < 184; i+=2){            //sore_list欄位最多到104
                if (!data[0][i] ) {break;}            //餐點名稱為空白時，跳出迴圈(已到菜單末端)
                strHTML2 = '<tr class = "text-primary"><th class="align-middle" scope="row"><h5>'+ num +'</h5></th><td><button type="button" class="btn btn-outline-primary  m-0 waves-effect" title="點我訂餐" data-toggle="modal" data-target="#centralModalLg"  onclick="modal(\''+ data[0][i] +'\',\''+ data[0][i+1] +'\');" ><h5>'+ data[0][i] +'</h5></button></td><td><h5>'+ data[0][i+1] +'</h5></td></tr>';
                $("#tb_tc").append(strHTML2);
                num ++;
            }  
            $(".col-lg-5").html(" ");
            $(".col-lg-5").append('<div class="card"><div class="card-body"><h2 class="card-title"><span class="badge badge-warning">訂單統計</span></h2><p class="card-text"></p><p class="card-text" id="comment"><p class="card-text" id="total_count"></p><p class="card-text" id="bill"></p><p class="card-text" id="subtotal"></p><div class="progress"></div><div id="del"></div></div></div>' );
            checkout();     //更新訂單

      }
      //show訂購購資訊及座號選單
      function modal(bd,bdp){
            $('#order_user').html('');
            $("#mybd").html("");
            $("#mybd").html(bd+"&nbsp;&nbsp;&nbsp;&nbsp;"+bdp+"元&nbsp;&nbsp;&nbsp;&nbsp;");
            $("#mybd").append('<input type="hidden" name="bd_name" id="bd_name" value="'+ bd +'">');
            $('#md_body').html("");

            for (var i = 0 ; i <= 30 ; i++){
                if (i < 10){
                    no = "0" + i;
                } else {
                    no = i;
                }
                NoHTML = '<div class="custom-control custom-radio custom-control-inline "><input type="radio" name="seat_no" onchange="check_order_user();"  class="custom-control-input" id="s_no'+ i +'"  value = "'+ i +'"><label class="custom-control-label" for="s_no'+ i +'" >'+ no +'</label></div>';
                $('#md_body').append(NoHTML); 
                $('#md_body').append("&nbsp;&nbsp;"); 

            }
            $('.modal-body').append("&nbsp;&nbsp;"); 

      }
      // 監聽座號         
       function check_order_user(){

            $.ajax({
              url:"get_usr_api.php",
              type:"post",
              data:{no: $('input[name="seat_no"]:checked').val()},
              dataType:"json",
              success:show_user,
              error:function(){
                alert("比對訂購者失敗!!");
              }
            });
       }
       function show_user(data){
              $('#order_user').html('訂購者： ' + data.username);
       };
       
      //訂購便當
      $("#order_bd").bind("click",function(){
          if($('input[name="seat_no"]:checked').val()){
            $("#rect").attr("fill","#007aff");
            toast_str1 ="訂餐成功!!";
            toast_str2 =$('input[name="seat_no"]:checked').val() + '號完成訂餐';
            $.ajax({
                url:"order_bd_api.php",
                type:"post",
                data:{bdname:$("#bd_name").val(), no:$('input[name="seat_no"]:checked').val(), order:$today},
                success:order_ok,
                error:function(){
                    alert("便當沒訂到喔!!");
                }
            });
          } else {
            alert("沒訂到喔，要選擇座號喔!!");
            
          }
      });
      function order_ok(data){
        if(data){
            toast(toast_str1,toast_str2);
            checkout();            //更新訂單
         } else {
            alert("訂購失敗!!");
         }
      }

      //更新訂單
      function checkout(){
            $.ajax({
                url:"checkout_api.php",
                type:"post",
                data:{today:$today},
                dataType:"json",
                success:show_checkout,
                error:function(){
                    alert("Get Menu Error!!")
                }
            });
      }
      function show_checkout(data){
            console.log(data);
            $("#owner").html(data.owner);
            if (data.bd_count != 0){                          //確認訂購數不為0
            $(".card-text").html(" ");
            $(".card-text").append('<h3><span class="badge  badge-secondary">' + data.store_name + '</span></h3><h6><span class="badge  badge-dark"><i class="fas fa-phone-square ">電話：</i> ' + data.store_tel + '</span></h6><hr><table class="table table-sm table-hover table-striped "><thead><tr><th scope="col"><h6>餐點名稱</h6></th><th scope="col"><h6>價錢</h6></th><th scope="col"><h6>數量</h6></th><th scope="col"><h6>訂購者</h6></th></tr></thead><tbody id="ch_tc" ></tbody></table><hr>');
                  for (var i = 0; i< data.bd.name.length ; i++){
                      bdname = data.bd.name[i];
                      price = data["bd_price"][bdname];
                      bdcount = data["bd"][bdname]["count"];
                      buyer = data["bd"][bdname]["buyer"];
                      bdid = "bd" +i;
                      strCHECKOUT = '<tr><th scope="row"><h5><span class="badge badge-pill badge-secondary">' + bdname + '</span></h5></th><td><h5>'+ price +'</h5></td><td><h5><span class="badge badge-pill badge-secondary">'+ bdcount +'</span></h5></td><td><h5><div id="'+ bdid + '"></div></h5></td></tr>';
                      console.log(strCHECKOUT);
                      $("#ch_tc").append(strCHECKOUT);
                      for (var j=0; j < data["bd"][bdname]["buyer"].length; j++){
                          check_buyer(bdid,data["bd"][bdname]["buyer"][j], data["bd"][bdname]["check"][j]);

                      }
                  }

                  $("#comment").html('<span class="badge badge-pill badge-info">' + data.comment +'</span>');
                  $("#total_count").html('<h4><span class="badge badge-pill badge-success">總便當數: ' + data.bd_count +'</span></h4>');
                  $("#bill").html('<h4><span class="badge badge-pill badge-success">總訂餐金額: ' + data.bill +'</span></h4>');
                  $("#subtotal").html('<h4><span class="badge badge-pill badge-danger">已收金額: ' + data.subtotal +'</span></h4>');
                   progress = (data.subtotal / data.bill*100).toFixed(0);    //計算收款進度
                   $(".progress").html('');
                   $(".progress").append('<div class="progress-bar" role="progressbar" style="width: '+ progress +'%" aria-valuenow="'+ progress +'%" aria-valuemin="0" aria-valuemax="100"></div>');
                   $("#del").html('');
                   $("#del").append('<div class="md-form"><input type="text" class="form-control" id="cancel_order" onchange = "get_name();"><label for="cancel_order">輸入座號取消訂餐</label><button class="btn btn-mdb-color waves-effect" onclick="cancel_btn();">取消訂餐</button></div>');       
            } else {                                             //訂購數為0,清空統計表
              $(".card-text").html(" ");
              $("#del").html('');
            }  
      }
      function check_buyer(bdid,buyer,check){             //產生訂單中訂購者資料
            id = "#" + bdid;
            var str="";
            if (check == 1){
                str = '<a href="#" class="badge badge-pill badge-success" onclick="check('+ buyer +')">' + buyer + '</a>';
                $(id).append(str);
            }else{
                str = '<a href="#" class="badge badge-pill badge-danger" onclick="check('+ buyer +')">' + buyer + '</a>';
                $(id).append(str);
            }
      }
      //收款或取消收款按鈕
      function check(no){
            $.ajax({
                url:"check_api.php",
                type:"post",
                data:{no:no,today:$today},
                success:checkout,
                error:function(){
                    alert("無法變更付款狀態!!");
                }
            });

      }

      function get_name(){
            $.ajax({
              url:"get_usr_api.php",
              type:"post",
              data:{no: $('#cancel_order').val()},
              dataType:"json",
              success:show_user,
              error:function(){
                alert("比對訂購者失敗!!");
              }
            });
       }
       function show_user2(data){
              console.log(data.username);
              $('#cancel_order').val('$("#cancel_order").val() + data.username');
       };


      //取消訂餐
      function cancel_btn(){
            num = $("#cancel_order").val();
             if ( num >= 0 && num <=30){
              $("#rect").attr("fill","red");
              toast_str1 ="取消訂單!!";
              toast_str2 =num + '取消訂餐成功!!<br>如有需要，請重新訂餐!!';
                      $.ajax({
                        url:"cancel_order_api.php",
                        type:"post",
                        data:{no:num,today:$today},
                        success:alert_cancel,
                        error:function(){
                          alert('刪除資料失敗!');
                        }
              });
             }

      };
      function alert_cancel(data){
        checkout();
        if (data == 1){
          toast(toast_str1,toast_str2);
          checkout();
        }
      }

      function toast(str1, str2){
        $(".mr-auto").html("");
        $(".mr-auto").html(str1);
        $(".toast-body").html("");
        $(".toast-body").html(str2);
        $('.toast').toast('show');
      }
  </script>
  </body>
</html>

