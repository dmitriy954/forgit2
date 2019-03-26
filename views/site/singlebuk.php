<?php
use yii\helpers\Url;

//$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['site/allincat','id'=>$idPage]];
$this->title = $buk->name;
$this->params['breadcrumbs'][] = $this->title;
$st = Yii::getAlias('@web'); $st = $st . "/uploads/";
  
//$str2 = '<img src = "/shop/basic/web/uploads/'. $buk->pathim . '.' . $buk->extim . '"/>';
$this->registerJsFile('@web/js/plusandminus2.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/star-rating/js/star-rating.min.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerJsFile('@web/js/rating.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerCssFile('@web/star-rating/css/star-rating.css', ['depends' => [app\assets\AppAsset::className()]]); 
// app\assets\AppAsset::className()
// \yii\web\JqueryAsset::className()
 // \yii\bootstrap\BoontstrapAsset::className()
?>

 <form id = "singleform" action="<?php echo Url::to(['site/noaja3']) ?>"   method = "post" >
 <input type="hidden" name="_csrf" value="QzB5eHYwX3I2YxYTT2UACAJaMSsmCBM0BGAxSBAAExU0VBsgIHgrJw==">
 <input type="hidden" name="kolofbuk" value = "1">
 <input type="hidden" name="bukid" value = "<?php echo $buk->id;?>">
<div class = "single-no-aja">
   <div class="bx-title_div"><h1 id="pagetitle" class="bx-title dbg_title"><?php echo $buk->name;?></h1></div>
   <div class="bx_lt">
       <?php
       $stim1 = $st . $bukims->pathim1; $stim1 = $stim1 . '.'; 
       $stim1 = $stim1 . $bukims->extim1;
	   $stmain = $stim1;
       $im1 = "<img src = '"  . $stim1 .  "'/>"; ?>
	   <div id = "bigim"><?php echo $im1;  ?></div>
	   
	   <div style = "margin-top: 20px; box-sizing: border-box; position: relative; display: block; width: 100%;">  
          <div class = "smallims smallims_active smallims_nomarg" id = "sm1" onclick = "fsm (1, '<?php echo $stim1; ?>'); "><?php echo $im1; ?> </div>
		  
		  
		 <?php if (strlen ($bukims->pathim2) > 2  )
		  {
			  $stim2 = $st . $bukims->pathim2; $stim2 = $stim2 . '.'; 
			  $stim2 = $stim2 . $bukims->extim2;
			  $im2 = "<img src = '"  . $stim2 .  "'/>";
		  }
		  else
		  {
			   $stim2 = $stim1;
			   $im2 = "<img src = '"  . $stim1 .  "'/>";
			  
		  }
			  
			  ?>
		 <div class = "smallims" id = "sm2" onclick = "fsm (2, '<?php echo $stim2; ?>'); "><?php 
		 echo $im2;
		   ?>  </div>
		   
		  <?php if (strlen ($bukims->pathim3) > 2  )
		  {
			  $stim3 = $st . $bukims->pathim3; $stim3 = $stim3 . '.'; 
			  $stim3 = $stim3 . $bukims->extim3;
			  $im3 = "<img src = '"  . $stim3 .  "'/>";
		  }
		  else
		  {
			   $stim3 = $stim1;
			   $im3 = "<img src = '"  . $stim1 .  "'/>";
			  
		  } ?>
		   
          <div class = "smallims" id = "sm3" onclick = "fsm (3, '<?php echo $stim3; ?>'); "><?php  
           echo $im3;
		  
		  ?>  </div>
		  
		  <?php if (strlen ($bukims->pathim4) > 2  )
		  {
			  $stim4 = $st . $bukims->pathim4; $stim4 = $stim4 . '.'; 
			  $stim4 = $stim4 . $bukims->extim4;
			  $im4 = "<img src = '"  . $stim4 .  "'/>";
		  }
		  else
		  {
			   $stim4 = $stim1;
			   $im4 = "<img src = '"  . $stim4 .  "'/>";
			  
		  } ?>
		   
          <div class = "smallims" id = "sm4" onclick = "fsm (4, '<?php echo $stim4; ?>'); "><?php  
           echo $im4;
		  
		  ?>  </div>
		  
		  <?php if (strlen ($bukims->pathim5) > 2  )
		  {
			  $stim5 = $st . $bukims->pathim5; $stim5 = $stim5 . '.'; 
			  $stim5 = $stim5 . $bukims->extim5;
			  $im5 = "<img src = '"  . $stim5 .  "'/>";
		  }
		  else
		  {
			   $stim5 = $stim1;
			   $im5 = "<img src = '"  . $stim5 .  "'/>";
			  
		  } ?>
		   
          <div class = "smallims" id = "sm5" onclick = "fsm (5, '<?php echo $stim5; ?>'); "><?php  
           echo $im5;
		  
		  ?>  </div>
		 
		 
		 
		 
		  
	   </div>
   </div>
   <div class="bx_rt">
      <div class="row">
	<?php  
	  if ($buk->rating)
		 $ratt = $buk->rating;
	    else $ratt = 0;
		
		if ($buk->kolrating)
		 $kolratt = $buk->kolrating;
	    else $kolratt = 0;
		
		?>
	  <div style = "padding-left: 15px;"><div style = "float: left;"><input type = "hidden" name = "for1" id = "forrating1" value = "<?php echo $ratt; ?>"></div> <div style = "float: left; color: #8d8d8d; font-size: 1em;  display: inline-block; vertical-align: middle; "> (<?php echo $kolratt; ?>)</div></div>
	  <div class = "clearfix"></div>
	  <div class="col-md-7" style = "margin-top: 10px; " id = "korzmy" data-id = "<?php echo $buk->id;?>" data-type = "bigbl"  >
            <a class="btn btn-warning btn-lg btn-block" href="javascript:void(0)" onclick="checkOut();" data-id="<?php echo $buk->id;?>" data-type="4">
                 <i class="fa fa-shopping-basket"></i>
                    Оформить заказ
           </a>
           <div class="paymethod">и другие способы оплаты</div>
         </div>
		 
		 <div style="clear: both;"></div>
					  <div  data-id = "<?php echo $buk->id;?>" data-type = "7xx" class = "parent_incart parent_divspin">
					            <img data-id = "<?php echo $buk->id;?>" data-type = "7" src = "spinner.gif" />
				     </div> 
		 <div style="clear: both;"></div>
		 
         <div class="col-md-5 text-right">
		 <?php  $pr = number_format($buk->price, 0, '', ' '); ?>  
           <div id="bx_117848907_431_price" class="item_current_price"><?php echo $pr;?> руб.</div>
          </div>
       </div>
	   
	   <div class = "clearfix"></div>
	   
	   
	   <div class="item_info_section" style = "margin-top: 10px">
         <div class="row">
             <div class="col-md-12">
             <div class="h5">Количество</div>
               </div>
            <div class="col-md-6">
                 <div class="basket_quantity_control buk_spin_single">
                  <div class="buk_spin_control_single minusminus" data-id="<?php echo $buk->id;?>">-</div>
                     <div class="buk_spin_input_single">
                           <input class="buck_input_target_single" data-id="<?php echo $buk->id;?>" data-type="2" name="quantity" value="1" type="text">
                     </div>
                     <div class="buk_spin_control_single plusplus" data-id="<?php echo $buk->id;?>">+</div>
                  </div>
            </div>
            <div class="col-md-6 text-right hidden-xs hidden-sm">
               <div id="bx_117848907_431_basis_price" class="item_section_name_gray" style="padding: 15px 0px;">Цена <?php echo $buk->price;?> руб. за 1 шт</div>
            </div>
         </div>
       </div>
       
       <div class="h5">Параметры букета</div>
	   
	   <ul class="list-inline hl_tooltip_li prop_li">
          <li>
              <i class="fa fa-arrows-v"></i>
                  <?php echo $buk->width;?> см
          </li>
          <li>
              <i class="fa fa-arrows-h"></i>
                <?php echo $buk->height;?> см
          </li>
          <li>
            <i class="fa fa-globe"></i>
          </li>
          <li>
              <i class="fa fa-info-circle"></i>
                 Букет цветов
          </li>
       </ul>
	   
	   
	   
	   <div class="item_info_section">
          <div class="garantia_main tag-box tag-box-v2 box-shadow shadow-effect-1">
             <div class="garantia_div1">
                <i class="fa fa-thumbs-o-up"></i>
                  Гарантия качества
             </div>
             <div class="garantia_div2">Если получателю не понравится букет, и Вы сообщите нам об этом в течение 24 часов, мы бесплатно его поменяем.</div>
          </div>
       </div>
	   
	   
	   <div class="item_info_section">
         <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i>
              Гарантируем полное соответствие букета фотографии.
         </div>
       </div>
   
   </div>

</div>
</form>


<script>
		 $(document).ready(init);
		 function init(){   
		  
		  $('.minusminus').on('click', ff2);
		  $('.plusplus').on('click', ff3);
		 $('[data-type = 2]').on('change', ff5);   
         $("#forrating1").rating({min:0, max:5, step:1, size:'xs', showClear: false, showCaption: false});
		 
		 $('#forrating1').on('rating.change', function(event, value, caption) {
       // alert (value);
	//   $('#forrating1').rating('update', value - 1);
	     $('#forrating1').rating('refresh', {displayOnly: true});
		 $adress = "<?php echo Url::to(["site/ajarating"]) ?>" ;
	     fratingajaposr (value, $adress, 1);
	
	
	
	
	
    });

		 }	 
		
		  
function fsm (val, imstr)	
{
	$im = "<img src = '"  + imstr +  "'/>"; 
	$('#bigim').html($im);
   // alert($im);
	$('.smallims').removeClass('smallims_active');
	if (val == 1)
	{
		$('#sm1').addClass('smallims_active');
	}
	if (val == 2)
	{
		$('#sm2').addClass('smallims_active');
	}
	if (val == 3)
	{
		$('#sm3').addClass('smallims_active');
	}
	if (val == 4)
	{
		$('#sm4').addClass('smallims_active');
	}
	if (val == 5)
	{
		$('#sm5').addClass('smallims_active');
	}
	
}	  
function ff5()
						{
							var per;
							per = $(this).val();
							alert ("jfnfj");
                           
                            var reg = /\D/;

// не глобальный регэксп, поэтому ищет только первую цифру
                            if (per.match(reg) )
							{
								per = $(this).val("1");
							}
							else
							{	
						  $('input[name=kolofbuk]').val(per);
						  $kk =  $('input[name=kolofbuk]').val();
						  alert ($kk);
							//per = Number(per);   // ничего не делаем, елсе просто так. 
							//per = $("#test338").val();
							}
							
						//	alert(per);
						}

		  
		  
		  
		  
		  
		  
function checkOut()
    {
		 $('#singleform').submit();
		
	
	
	
    }
		  
		  
		  
		  
		
		
		 


		  
</script>