<?php
class order_list
{
  public $order_name;      //訂單名稱
  public $store_name;      //店名
  public $owner;           //值日生座號
  public $comment;         //店家備註
  public $ip;              //值日電腦ip
  public $store_tel;       //訂餐電話
  public $bill;            //應付總金額
  public $subtotal = 0;        //收款小計
  public $bd_array = array();        //餐點陣列：name, count, buyer(array), check state(array)
  public $bd_count_total = 0;  //總便當數
  public $bd_price = array(); //餐點價格
  //匯整訂單資料
  public function checkout($order_name){
    include 'connn.inc';
    $this->order_name = $order_name;
    $sql="SELECT * FROM order_record WHERE order_name =\"".$this->order_name."\"" ;
    $result = $link->prepare($sql);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_BOTH);
    $this->store_name = $row[2];
    $this->owner = $row[3];
    //記錄便當訂購資料
    $num = 0;                 //座號
    for($i=6;$i<=66;$i+=2){
        if (!is_null($row[$i])){
            if (is_null($this->bd_array[$row[$i]])){
                $this->bd_count_total ++;
                $this->bd_array[name][] = $row[$i];                //新增訂購便當名稱到陣到
                $this->bd_array[$row[$i]][count] ++;
                $this->bd_array[$row[$i]][buyer][] = $num;
                $this->bd_array[$row[$i]][check][] = $row[$i+1];
            }else{
                
                $this->bd_count_total ++;                          //訂單便當總數量+1
                $this->bd_array[$row[$i]][count] ++;               //單一便當數量相+1
                $this->bd_array[$row[$i]][buyer][] = $num;         //記錄便當計購者
                $this->bd_array[$row[$i]][check][] = $row[$i+1];   //記錄繳費柵位
            }
        }
        $num ++; //座號
    }
    //查詢各種便當價錢
    $sql2="SELECT * FROM store_list WHERE store_name =\"".$row["store_name"]."\"" ;
    $result2 = $link->prepare($sql2);
    $result2->execute();
    $row2 = $result2->fetch(PDO::FETCH_NUM);
    $this->store_tel = $row2[2];
    $this->comment = $row2[3];
    foreach ($this->bd_array[name] as $key => $value ){
            $this->bd_price[$value] = $row2[array_search($value,$row2)+1];  //將便當價格存入陣列
    }
    $link = null;
    //計算總金額
    foreach ($this->bd_array[name] as $key => $value ){
        $bdname = $value;
        $this->bill = $this->bill + ($this->bd_array[$bdname][count] * $this->bd_price[$bdname]);
        // echo "總金頟:".$this->bill."(".$this->bd_array[$bdname][count] ."*". $this->bd_price[$bdname].")";
    }
  }
  //收款計算
  public function count_subtotal(){
    foreach ($this->bd_array[name] as $key => $value ){
        $bdname = $value;
        $paid_count = 0;
        foreach ($this->bd_array[$bdname][check] as $key2 => $value2){
            $paid_count += $value2;
        }
        $this->subtotal = $this->subtotal + ($this->bd_price[$bdname] * $paid_count) ;

    }
  }
  //show出店家menu
  public function show_menu($s_name){
    $this->store_name = $s_name;
    include 'connn.inc';
    $sql="SELECT * FROM store_list WHERE store_name =\"".$this->store_name."\"" ;
    $result=$link->query($sql);
    $myArray=Array();
    foreach($result as $row){
        $myArray[]=$row;
    }
    echo json_encode($myArray);
    $link = null;
  }
  
  //取糐store_list裡所有店家名稱，作select option
  public function get_sname(){
    include 'connn.inc';
    $sql="SELECT store_name FROM store_list limit 5" ;
    $result=$link->query($sql);
    $myArray=Array();
    foreach ($result as $row) {
        $myArray[]=$row;
    }
    echo json_encode($myArray);
    $link = null;
  }

  //建立當日便當訂單
  public function create_order($oname,$sname,$owner,$ip){
    include 'connn.inc';
    $this->order_name = $oname;
    $this->store_name = $sname;
    $this->owner = $owner;
    $this->ip = $ip;
    echo $this->order_name."&".$this->store_name."&".$this->owner."&".$this->ip ;
    $sql="INSERT INTO order_record (order_name, store_name, owner, ip) VALUES ('".$this->order_name."','".$this->store_name."','".$this->owner."','".$this->ip."')"; 
    if(!$link->query($sql)) {
        printf_r($link->errorInfo()) ;
    }
    $link = null;
  }
}

?>
