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
      font-family:Microsoft JhengHei;
    }
    #btn{
      position: fixed;
      background-color: rgba(150,150,100,0.4);
      border-radius: 5%;
      padding: 10px;


    }
    #list{
      position: fixed;
    }
    @media (max-width: 768px) {
          #btn{
          position: relative;
          background-color: rgba(150,150,100,0.4);
          border-radius: 5%;
          padding: 10px;

        
        }
        #list{
          position: relative;
        }
    }

  </style>
</head>
  <body style="position: relative;" class="text-primary font-weight-bold">
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

<div class="container ">
  <div class="row">
    <div class="col-lg-1 py-5 mr-5">
        <div id="list">
          <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header"><h5 class="font-weight-bold text-secondary">資料庫已有資料</h5></div>
            <div class="card-body text-primary">
                  <div class="table-responsive ">
                    <table class="table table-hover">
                      <thead>
                        <tr class="text-primary">
                          <th scope="col">#</th>
                          <th scope="col">店家名稱</th>

                        </tr>
                      </thead>
                      <tbody id="tb_list" class="text-primary">

                      </tbody>
                    </table>
                  </div>              
            </div>
          </div>    
        </div>     
    </div>
    <div class="col-lg-5 mr-5 ml-auto ">
        <div class="py-5">
            <div class="row">
              <div class="col-lg-12">
                <span>店家名稱</span><input class="form-control" type="text" id="store_name"><div id="err_store_name"></div>
              </div>
              <div class="col-lg-12">
                <span>店家電話</span><input class="form-control" type="text" id="store_tel">
              </div>
              <div class="col-lg-12">
                <span>註記(如…折價、優惠、休息日)</span><input class="form-control" type="text" id="comment">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                    <table class="table table-hover text-primary">
                      <thead>
                        <tr class="text-center">
                          <th scope="col">#</th>
                          <th scope="col">餐點名稱</th>
                          <th scope="col">餐點價格</th>
                        </tr>
                      </thead>
                      <tbody id="tb_ct" class="text-center text-primary">

                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>      
    </div>
    <div class="col-lg-3 py-5 ">
      <div id="btn">
        <h5 style="color: red">注意事項：</h5>
        <ul style="color: red">
          <li>店家名稱及店家電話必填</li>
          <li>餐點名稱依編號序填入，勿跳著填</li>
        </ul>  
        <button type="button" class="btn btn-danger" id="ok_btn">輸入資料完成<br>按此按鈕新增店家資料</button>
      </div>             
    </div>
  </div>  
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
    $(function(){
      for (var i=1;i<=90;i++){
        bdname = "bdName" + i;
        bdprice = "bdPrice" + i;
        str ='<tr><th scope="row">' + i + '</th><td><input class="form-control" type="text" id="' + bdname + '"></td><td><input class="form-control" type="number" id="' + bdprice + '"></td</tr>';
        $('#tb_ct').append(str);
      }

      show_storelist(); 
    });
    $('#ok_btn').bind("click",function(){
      data_str= "'', '" + $('#store_name').val() + "', '" +$('#store_tel').val() + "', '" +$('#comment').val() +"'" ;
      data_col= "id, store_name , store_tel, comment";
      for (var i=1;i<=90;i++){
        bdname = $('#bdName' +i).val();
        bdprice =$('#bdPrice' +i).val();
        data_str = data_str + ", '" + bdname + "', '" + bdprice +"'";
        data_col = data_col + ', bdName' + i + ', bdPrice' + i ;
      }
      $.ajax({
        url:"addstore_api.php",
        type:"post",
        data:{store:data_str,data_col:data_col},
        success:show,
        erroe:function(){
          alert("傳送資料發生錯誤!!");
        }
      });
    }); 
    function show(data){
      console.log(data); 
      clear_table();
      location.href = "addstore.php";
    }


    $('#store_name').bind("input propertychange",function(){
      if($('#store_name').val().length = 0){
          $('#err_store_name').html("店家名稱不可空白!!");
          $('#err_store_name').css("color","red");
      }
    });

    // 查詢所有店家名稱
    $(function(){
        $.ajax({
            url:"get_store_name_api.php",
            type:"GET",
            dataType:"JSON",
            success:show_storelist,
            error:function(){
                alert("Get Option Error!!")
            }
        });
    });
    // 匯入店名資訊到表格
    function show_storelist(data){
        for (var i = 0; i < data.length; i++){
            strHTML ='<tr><th scope="row">' + (i+1) + '</th><td>'+ data[i].store_name +'</td></tr>';
            $("#tb_list").append(strHTML);
        }
    }


    function get_data(sn){
        clear_table();
        sname = sn;
        $.ajax({
            url:"get_menu_api.php",
            type:"post",
            data:{sname:sname},
            dataType:"json",
            success:input,
            error:function(){
                alert("Get Menu Error!!")
            }
        });
    }
    function input(data2){
       console.log(data2);
       console.log(data2[0][1]);
       $('#store_name').val(data2[0][1]) ;
       $('#store_tel').val(data2[0][2]) ;
       $('#comment').val(data2[0][3]) ;
        for (var i=0;i<=90;i++){
         $('#bdName' +i).val(data2[0][4+2*i]) ;
         $('#bdPrice' +i).val(data2[0][4+2*i+1]) ;
       }
    }
      
    function clear_table(){
       $('#store_name').val('');
       $('#store_tel').val('');
       $('#comment').val('');
       for (var i=1;i<=90;i++){
         $('#bdName' +i).val('');
         $('#bdPrice' +i).val('');
       }
    }

  </script>    
  </body>
</html>

