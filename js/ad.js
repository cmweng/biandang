// 需注意檔名、網址等陣列內容是否正確
var index=0;
var currimg,currhref,currcont;
var aryimg=new Array ("01.png","02.png","03.png","04.png","05.png","06.png");
var aryhref=new Array("https://tw.canon/zh_TW/consumer","https://tw.canon/zh_TW/consumer/eos-rp-body/product?category=photography&subCategory=mirrorless-eos-r","https://tw.canon/zh_TW/consumer/eos-5d-mark-iv-body/product?category=photography&subCategory=dslr-eos","https://tw.canon/zh_TW/consumer/eos-80d-kit-ef-s18-55-is-stm/product?category=photography&subCategory=dslr-eos","https://tw.canon/zh_TW/consumer/eos-77d-kit-ef-s18-135-is-usm/product?category=photography&subCategory=dslr-eos","https://tw.canon/zh_TW/consumer/eos-800d-kit-ef-s18-55-is-stm/product?category=photography&subCategory=dslr-eos");
var arycont=new Array("Canon官網","EOS RP","EOS 5D IV","EOS 80D Kit (EF-S18-55 IS STM)","EOS 77D Kit (EF-S18-135 IS USM)","EOS 800D Kit (EF S18-55 IS STM)");


$(function(){
  setInterval(function(){
  	index++;
  	if(index>5){                                //依使用狀況修改index最大值
  		index=0;
  	}
  	currimg="images/"+ aryimg[index]; 
  	currhref=aryhref[index];
  	currcont=arycont[index];
  	$("#logo").attr("src",currimg);             //替換logo圖片, id==> logo
    $("#href").attr("href",currhref);           //替換logo連結網址, id==> href
    $("#cont").text(currcont);                  //替換logo說明文字, id==> cont
 },1500);

});

