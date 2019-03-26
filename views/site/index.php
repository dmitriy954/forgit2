<?php
use yii\helpers\Url;

$stal = Yii::getAlias('@web'); 
$base_str_to_ims0 = $stal . "/uploads/cat/";
$base_str_to_ims1 = $stal . "/uploads/cat/1/";
$base_str_to_ims2 = $stal . "/uploads/cat/2/";
$base_str_to_ims3 = $stal . "/uploads/cat/3/";
$base_str_to_ims4 = $stal . "/uploads/cat/4/";
$base_str_to_ims = $stal . "/uploads/";
$this->registerJsFile('@web/js/aja123.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/plusandminus.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/magnificmy.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/star-rating/js/star-rating.min.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerJsFile('@web/js/rating.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerCssFile('@web/star-rating/css/star-rating.css', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerJsFile('@web/js/fsm.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/tabs.js', ['depends' => [app\assets\AppAsset::className()]]); 
?>



<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
<script>
/*
$.magnificPopup.open({
  items: {
    src: '<div class="white-popup">Dynamically created popup333</div>',
  },
  type: 'inline',

  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
});
*/
</script>
   
		 

    <div class="col-md-12 hidden-xs" style="margin-bottom: 25px;">
       <div class="row tab-v3">  
	      <div class="col-sm-3">
		  
		  
		     <ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="javascript:void()" onclick = "tab1();" data-toggle="tab" aria-expanded="true"><i class="fa fa-gift"></i> Выберите повод</a></li>
			<li class=""><a href="javascript:void()" onclick = "tab2();" data-toggle="tab" aria-expanded="false"><i class="fa fa-heart"></i> <span style="left: -5px; position: relative;">Выберите кому</span></a></li>
			<li class=""><a href="javascript:void()" onclick = "tab3();" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> Выберите букет</a></li>
			<li class=""><a href="javascript:void()" onclick = "tab4();" data-toggle="tab" aria-expanded="false"><i class="fa fa-star"></i> VIP</a></li>
		     </ul>
	   
	      </div>
		  
		  <div class="col-sm-9">
		  <?php $imhref = $base_str_to_ims0 . "ps.jpg"; 
		  
		  ?>
          
	
		  <div class="tab-content">
			
			    <div id="povod" class="tab-pane fade in active tabs_main_page">
				  <div class = "row">
				    <?php foreach  ($categories1 as $categ)
					{  
					$imhref = $base_str_to_ims1 . $categ->imname . "." . $categ->imext;
					
					
					?>
						
						<div class="col-sm-6 col-md-4 tabs_main_page_items">
                         <div class="row">
	                         <div class="col-lg-4 col-md-4 col-sm-4">
		                         <a href="#">
			                         <img src="<?php echo $imhref; ?>">
		                         </a>
	                         </div>
	                         <div class="col-lg-8 col-md-8 col-sm-8 tabs_items_name">
							 <?php 
							 $ur = Url::to(['site/allbukets', 'unioncat' => $categ->id]);
	                           echo '<a href='.$ur.'>';  ?>
	 
		                        
			                         <?php echo $categ->name; ?>
		                         </a>
	                         </div>
                         </div>
                    </div>
				
				 <?php	}  ?>
				  
				  
				  </div>

				</div>
				
				
				
			    <div id="flowers" class="tab-pane fade in tabs_main_page">
				  <div class = "row">
				    <?php foreach  ($categories2 as $categ)
					{  
					$imhref = $base_str_to_ims2 . $categ->imname . "." . $categ->imext;
					
					
					?>
						
						<div class="col-sm-6 col-md-4 tabs_main_page_items">
                         <div class="row">
	                         <div class="col-lg-4 col-md-4 col-sm-4">
		                         <a href="#">
			                         <img src="<?php echo $imhref; ?>">
		                         </a>
	                         </div>
	                         <div class="col-lg-8 col-md-8 col-sm-8 tabs_items_name">
		                       <?php  $ur = Url::to(['site/allbukets', 'unioncat' => $categ->id]);
	                           echo '<a href='.$ur.'>';  ?>
			                         <?php echo $categ->name; ?>
		                         </a>
	                         </div>
                         </div>
                    </div>
				
				 <?php	}  ?>
				  
				  
				  </div>

				</div>
				
				
				
				
			    <div id="for" class="tab-pane fade in tabs_main_page">
				  <div class = "row">
				    <?php foreach  ($categories3 as $categ)
					{  
					$imhref = $base_str_to_ims3 . $categ->imname . "." . $categ->imext;
					
					
					?>
						
						<div class="col-sm-6 col-md-4 tabs_main_page_items">
                         <div class="row">
	                         <div class="col-lg-4 col-md-4 col-sm-4">
		                         <a href="#">
			                         <img src="<?php echo $imhref; ?>">
		                         </a>
	                         </div>
	                         <div class="col-lg-8 col-md-8 col-sm-8 tabs_items_name">
		                         <?php  $ur = Url::to(['site/allbukets', 'unioncat' => $categ->id]);
	                              echo '<a href='.$ur.'>';  ?>
			                         <?php echo $categ->name; ?>
		                         </a>
	                         </div>
                         </div>
                    </div>
				
				 <?php	}  ?>
				  
				  
				  </div>

				</div>
				
				
				
				
			    <div id="ekz" class="tab-pane fade in tabs_main_page">
				  <div class = "row">
				    <?php foreach  ($categories4 as $categ)
					{  
					$imhref = $base_str_to_ims4 . $categ->imname . "." . $categ->imext;
					
					
					?>
						
						<div class="col-sm-6 col-md-4 tabs_main_page_items">
                         <div class="row">
	                         <div class="col-lg-4 col-md-4 col-sm-4">
		                         <a href="#">
			                         <img src="<?php echo $imhref; ?>">
		                         </a>
	                         </div>
	                         <div class="col-lg-8 col-md-8 col-sm-8 tabs_items_name">
		                         <?php  $ur = Url::to(['site/allbukets', 'unioncat' => $categ->id]);
	                           echo '<a href='.$ur.'>';  ?>
			                         <?php echo $categ->name; ?>
		                         </a>
	                         </div>
                         </div>
                    </div>
				
				 <?php	}  ?>
				  
				  
				  </div>

				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			  
			</div>
		  
		  </div>
	   
	   
	   
	   
	   </div>
    </div>
	
	

					
<div class="bx-content col-md-12">
					
  <div class="row" style="margin-bottom: 20px;">
	<div class="col-sm-3">
		<a href="<?php  $ur = Url::to(['site/allbukets', 'price2' => 2000]);  echo $ur;  ?>	" class="btn btn-danger btn-lg btn-block" style="margin-bottom: 20px;">до 2000 <i class="fa fa-rub"></i></a>
	</div>

	<div class="col-sm-3">
		<a href="<?php  $ur = Url::to(['site/allbukets', 'price1' => 2000, 'price2' => 4000]);  echo $ur;  ?>	" class="btn btn-success btn-lg btn-block" style="margin-bottom: 20px;">2000 - 4000 <i class="fa fa-rub"></i></a>
	</div>
	<div class="col-sm-3">
		<a href="<?php  $ur = Url::to(['site/allbukets', 'price1' => 4000]);  echo $ur;  ?>	" class="btn btn-success btn-lg btn-block" style="margin-bottom: 20px;">4000 - 6000 <i class="fa fa-rub"></i></a>
	</div>
	<div class="col-sm-3">
		<a href="<?php  $ur = Url::to(['site/allbukets', 'unioncat' => 86]);  echo $ur;  ?>	" class="btn btn-warning btn-lg btn-block" style="margin-bottom: 20px;"><b>VIP</b></a>
	</div>
  </div>


<div class="heading heading-v1">
   <h1>Доставка цветов по СПб</h1>
</div>

<div class="tag-box tag-box-v6 hidden-xs" style="margin: 15px 0px 20px 0px;">
<p>Хотите поздравить, восхитить, удивить или влюбить – бесплатная доставка цветов по Санкт-Петербургу от салона Букеты  поможет добиться желаемого!</p>
Наш интернет-магазин принимает заказы с возможностью оплаты на сайте (40 вариантов оплаты), а курьерская служба сервиса Букеты
<b>доставляет цветочные композиции в течение 2 часов</b>
с момента оформления заказа –
<b>7 дней в неделю, 365 дней в году</b>
. Самая современная и популярная среди покупателей доставка букетов цветов - реально недорого и удобно для каждого жителя мегаполиса!
</div>

<div class="heading heading-v4">
   <div class="h2">Хиты продаж</div>
</div>


<div class="bx_catalog_list_home col4 bx_green">


     <?php foreach ($buketi as $buk) 
                  {  $k++;   ?>
		           
		      
		
			  
			  <?php
			//  $pathim = $base_str_to_ims . $buk->pathim . "_thumb" . "." . $buk->extim;
			  $pathim = $base_str_to_ims . $buk->pathim . "." . $buk->extim;
			  ?>
			  <div class = "buket_parent buket_parent_4">
			     <div class = "buket_parent2">
				 
		             <a id="bx_3966226736_7975_pict" class="foto_href onebukaja2" target = "_blank" href="<?php echo Url::to(['site/buketaja', 'id' => $buk->id]) ?>"  title="<?php echo $buk->name;?>">
		              
					  <img src = "<?php echo $pathim;?>" />
					 </a>
					 
					 <div class="buk_title">
					 <a class = "onebukaja2" target = "_blank" href="<?php echo Url::to(['site/buketaja', 'id' => $buk->id]) ?>" title="<?php echo $buk->name;?>"><?php echo $buk->name;?></a>
                     </div>
					 <?php 
					 $buf = $buk->price;
					 $buf = number_format($buf, 0, '', ' '); ?>
                     <div class = "buk_price"><?php echo $buf;?> руб.</div>
					
					 
                     <div data-id = "<?php echo $buk->id;?>" data-type = "1" class = "buk_spin">
					    <div  class = "buk_spin_control minusminus" data-id = "<?php echo $buk->id;?>">-</div>
						<div class = "buk_spin_input">
						  <input   data-id = "<?php echo $buk->id;?>" data-type = "2"  class="buck_input_target" name="quantity" value="1" type="text" >
						</div>
						
						<div  class = "buk_spin_control plusplus" data-id = "<?php echo $buk->id;?>">+</div>
					 </div>
					
					 
					 
					 
					 
				<div id ="korzmy"  data-id = "<?php echo $buk->id;?>" data-type = "bigbl"      >
					 
					 <div data-id = "<?php echo $buk->id;?>" data-type = "4xx"  class = "parent_incart">
					            <a data-id = "<?php echo $buk->id;?>" data-type = "4" class="btn btn-success incart"  href="javascript:void()" rel = "nofollow">Купить</a>
				     </div> 
					 
					 
					 
				</div>	 
					 
					 <div style="clear: both;"></div>
					  <div  data-id = "<?php echo $buk->id;?>" data-type = "7xx" class = "parent_incart parent_divspin">
					   <?php $st = Yii::getAlias('@web'); $st = $st . "/spinner.gif"; ?>
					            <img data-id = "<?php echo $buk->id;?>" data-type = "7" src = <?php echo $st; ?> />
				     </div> 
					 <div style="clear: both;"></div>
					 
					 <div class = "articuls_items">
					 
					    <ul class="list-inline hl_tooltip_li prop_li">
					     <?php if ($buk->height != NULL) { echo "<li><i class='fa fa-arrows-v'></i> ".$buk->height . " см</li>	"; }			
						  if ($buk->width != NULL) { echo "<li><i class='fa fa-arrows-h'></i> ". $buk->width  . " см</li>	"; } 			
						   if ($buk->fromcountry != NULL) { echo "<li><i class='fa fa-globe'></i> ". $buk->fromcountry  . "</li>	"; } 	
						   if ($buk->info != NULL) { echo "<li><i class='fa fa-info-circle'></i> ". $buk->info  . "</li>	"; }  ?>	
						  
				        </ul>
					 
					 
					 </div>
					 
					
				 
				 </div>
			  </div>
			  
			 
			   <?php } ?>

           <div class="clearfix"></div>
       </div>
    <div class="clearfix"></div>


     <div class="center-block" style="max-width:400px; margin-bottom: 85px;"> 
          <a class="btn btn-warning btn-lg btn-block" href="<?php echo Url::to(['site/allbukets']) ?>">Посмотреть все букеты</a>
     </div






  
</div>	
	
	
	
	
	
	
	
	
	
	
	
	

</div>

<script>
		 $(document).ready(init);
		
		
		 
		 
		 
		 
		  function init(){   
		  $('.incart').on('click', myf);  
		  $('[data-type = 4]').on('click', ajaposr);
		  $('[data-type = 6]').on('click', ajaposr2);
		  $('.minusminus').on('click', ff2);
		  $('.plusplus').on('click', ff3);
		   $('.minusminus_mp').on('click', ff2_mp);
		  $('.plusplus_mp').on('click', ff3_mp);
		  
		  
		  $('[data-type = 2]').on('change', ff5);
		   magnif_posr();
		  
		  
		  
		 
		/*  $.magnificPopup.open({
 
      src: '<div class="white-popupyii2">идет обработка данных...</div>',
      type: 'inline',
 
});	 */


		  
		 }
		 function myf() {

}






function magnif_posr()
	  {
		  
		  $addr = '<?php echo Url::to(["site/ajarating"]) ?>';
		 // alert ($addr);
		  magnif ($addr);
	  }	  
	  
	  // открывается окно попапа с товаром. при клике на оформить заказ вызывется эта функция	
function ajamp_posr() {

	    $perr = $(this).attr("data-id_mp");
	    $addr = '<?php echo Url::to(['site/aja1']); ?>';
        $addrimg = '<?php $st = Yii::getAlias('@web'); $st = $st . "/images/mcheck01.png"; echo $st; ?>'
	    ajamp ($perr, $addr, $addrimg);
       }
		 

function ajaposr () {
	
	$adress = "<?php echo Url::to(["site/aja1"]) ?>" ;
	$adress2 = "<?php echo Url::to(["cart/index"]) ?>" ;
	//alert ($per);
	
	$perr = $(this).attr("data-id");
	$kol = $('[data-id ='+$perr+'][data-type = 2 ]').val();
	
	$forsent = $perr + "ddd" + $kol;
	
	aja($adress, $adress2,  $forsent, $perr);
	
}

function ajaposr2 () {
	
	$adress = "<?php echo Url::to(["site/aja2"]) ?>" ;
	$adress2 = "<?php echo Url::to(["cart/index"]) ?>" ;
	//alert ($per);
	
	$perr = $(this).attr("data-id");
	
	
	$kol = $('[data-id ='+$perr+'][data-type = 2 ]').val();
	
	$forsent = $perr + "ddd" + $kol;
	
	aja2($adress, $perr);
	
}
		 

		 

	
</script>
		 
