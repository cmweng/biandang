<?php 
//此api功能：在統計訂單資料，以json何回傳前端
error_reporting(0);
$today = $_POST["today"];

include 'order_list.inc';
$order_list=new order_list();
$order_list->checkout($today);        //呼叫order_list物件check out函數，統計訂單資料
$order_list->count_subtotal();        //計算目前已收便當錢
$checkout = json_encode(Array(
                  'owner' => $order_list->owner,
                  'store_name' => $order_list->store_name,          //訂單名稱
                  'store_tel'=>$order_list->store_tel,              //店家電話
                  'comment'=>$order_list->comment,                  //店家註記
                  'bd' => $order_list->bd_array,                    //今日有訂購餐點(便當)名稱陣列
                  'bd_count' => $order_list->bd_count_total,        //今日訂購便當總數
                  'bd_price' => $order_list->bd_price,              //餐點名稱對雁餐點價錢陣列
                  'bill' => $order_list->bill,                      //今日訂單總金
                  'subtotal'=> $order_list->subtotal,                //目前已收便當錢
                  'test' => ''
              ));
    echo $checkout;
  
 ?>
