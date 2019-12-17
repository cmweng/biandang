<?php 
    // 接收今天日期
    $today = $_GET["today"];
 ?> 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
    <title>訂便當了!先選店家吧!!</title>

  </head>
  <body>
    <div class="container" >
        <!-- 將今天日期設為隱藏tag，待傳至create order -->
        <?php echo '<input type="hidden" value = "'.$today.'" id="today">'; ?>  
        <!-- 建立店家選單 -->
        <select class="browser-default custom-select" name="sname" id="sname">
        </select>
        <!-- show店家資訊及菜單 -->
        <div id="store_info">
        </div>

        <table class="table" id="tb_ct">
        </table>
        
        <div id="btn">
            
        </div>
    </div>
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
          <div class="modal-body d-flex flex-wrap">

                <!-- Group of default radios - option 1 -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">取陗</button>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="ok2();">確定</button>
          </div>
        </div>
      </div>
    </div> 
    <!-- Central Modal Small -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
    <script>
        
        // 查詢所有店家名稱
        $(function(){
            $.ajax({
                url:"get_store_name_api.php",
                type:"GET",
                dataType:"JSON",
                success:show_option,
                error:function(){
                    alert("Get Option Error!!")
                }
            });
        });
        // 匯入店名資訊到選單
        function show_option(data){
            console.log(data.length);
            $("#sname").append('<option value="" disabled selected>選擇今天要訂餐的店家</option>');
            for (var i = 0; i < data.length; i++){
                strHTML = '<option value="'+ data[i].store_name +'">'+ data[i].store_name +'</option>';
                $("#sname").append(strHTML);
            }
        }
        // 監聽選單，取得店家名稱，再查詢店家菜單資訊
        $("#sname").on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
            $.ajax({
                url:"get_menu_api.php",
                type:"post",
                data:{sname:this.value},
                dataType:"json",
                success:get_menu,
                error:function(){
                    alert("Get Menu Error!!")
                }
            });
        });
        // show菜單
        function get_menu(data2){
            $("#tb_ct").html(" ");
            $("#btn").html(" ");
            $("#store_info").html('<h1>' + data2[0].store_name +'</h1>' );
            // 新增"店名"的隱藏標籤
            $("#store_info").html('<input type="hidden" value = ' + data2[0].store_name + ' id="store_name">');
            $("#store_info").append('<h3>' + data2[0].store_tel +'</h3>' );
            strHTML1 = '<thead class="thead-dark"><tr><th scope="col">#</th><th scope="col">餐點</th><th scope="col">價錢</th></tr></thead>';
            $("#tb_ct").append(strHTML1);
            $("#tb_ct").append('<tbody>');
                num = 1;
                for(var i = 4; i < 184; i+=2){
                    if (!data2[0][i] ) {break;}
                    strHTML2 = '<tr><th scope="row">'+ num +'</th><td>'+ data2[0][i] +'</td><td>'+ data2[0][i+1] +'</td></tr>';
                    $("#tb_ct").append(strHTML2)
                    num ++;
                }       
            $("#tb_ct").append('</tbody>');
            // 確認按鈕
            $("#btn").append('<button type="button" class="btn btn-outline-success waves-effect" data-toggle="modal" data-target="#centralModalLg" onclick="check_order();"><i class="far fa-thumbs-up" aria-hidden="true" >   確定</i></button>');
        }
        
        
        function ok2(){
            // 將日期、店名傳至create order
            if($('input[name="seat_no"]:checked').val()){
                location.href = "create_order_api.php?today=" + $("#today").val() + "&sname=" +$("#store_name").val() + "&owner=" +$('input[name="seat_no"]:checked').val();
            }else{
                alert("必預選擇座號!");
            }
            
        }          
      

      //確認訂單是否產生
      function check_order(){
         $.ajax({
            url:"check_order_api.php",
            type:"post",
            data:{today:$("#today").val()},
            success:show,
            error:function(){
                alert("check order api error!");
            }
         }); 
      } 
      function show(data){
        if(data){
            //訂單已產生
            alert("今天訂單已產生");
            location.href="index.php";     
         } else if (data == ""){

            $("#mybd").html("");
            $("#mybd").html("值日生座號");
            $('.modal-body').html("");
            for (var i = 0 ; i <= 30 ; i++){
                if (i < 10){
                    no = "0" + i;
                } else {
                    no = i;
                }
                NoHTML = '<div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" id="s_no'+ i +'" name="seat_no" value = "'+ i +'"><label class="custom-control-label" for="s_no'+ i +'">'+ no +'</label></div>';
                $('.modal-body').append(NoHTML); 
                $('.modal-body').append("&nbsp;&nbsp;"); 
                if (i == 11 || i == 23 ) $('.modal-body').append("<br>"); 
            }
          }
      }

    </script>

  </body>
</html>






