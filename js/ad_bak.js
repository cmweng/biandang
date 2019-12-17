		//需砲確認檔案路徑與名稱是否正確
    //需確認圖片 id是否為ppic
    $(function(){
		  var i=0;
		  var arrImgSrc= new Array("EOS_R_Kit.png","eos_5d_mk_iv_kit.png","eos1d_x_mkii.png")    //檔案名稱
		  var curImg;
          setInterval(function(){
                i--;         	
               if(i<0){i=2};
               curImg="images/"+arrImgSrc[i];                        //檔安路徑
               $("#ppic").attr("src",curImg);                        //圖片id
          },1500)
        });
          