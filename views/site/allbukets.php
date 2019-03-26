
<?php
//echo "jhfjhjf";

use yii\jui\Slider;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;

$this->registerJsFile('@web/js/aja123.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/plusandminus.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/magnificmy.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/star-rating/js/star-rating.min.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerJsFile('@web/js/rating.js', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerCssFile('@web/star-rating/css/star-rating.css', ['depends' => [app\assets\AppAsset::className()]]);
$this->registerJsFile('@web/js/search.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/filtaja.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/slidermy.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/fsm.js', ['depends' => [app\assets\AppAsset::className()]]); 
$this->registerJsFile('@web/js/otherallbukets.js', ['depends' => [app\assets\AppAsset::className()]]); 


//echo Yii::$app->request->get('page', 100);
//echo "x18";
//$id = "allbukmain";
// if ($this->beginCache($id, ['duration' => 0])) {
if ($searchq === -1)
  {
	$valsearch = NULL;
  }	
else
  {
	$valsearch = $searchq;
	
  }
	?>
<?= Html::beginForm(Url::to(['/site/allbukets']), 'get', ['class' => '', 'style' => 'margin-bottom: 0px; padding-left: 0px; padding-right: 0px;' ]) ?>
        <div class="input-group">
          <?= Html::textInput('searchq', $valsearch, [  'class' => 'form-control', 'placeholder' => 'Поиск...', 'onfocus' => 'fsearch1foc()', 'onblur' => 'fsearch2blur()', 'onkeyup' => 'fsearch3up_posr()' ]) ?>
          <span class="input-group-btn">
            <?= Html::a('<i class="glyphicon glyphicon-search"></i>', 'javascript:void(0)', ['class' => 'btn btn-primary', 'onclick' => "click_search()"]) ?>
          </span>
        </div><!-- /input-group -->
<?= Html::endForm() ?>

<div style = "width: 100%; position: relative; height: 10px; padding: 0; ">
   <div class = "rezsearchabs" >
      
   </div>   
</div>

<?php	
	
 if ($idcat > -1)
  {

     echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n", // template for all links
    'links' => [
        
        ['label' => 'Все букеты', 'url' => ['site/allbukets']],
        $idname,
      ],
     ]);	
    $this->title = $idname;

  }
else {
	
	  if ($searchq > -1)
         {
			  echo Breadcrumbs::widget([
             'itemTemplate' => "<li>{link}</li>\n", // template for all links
               'links' => [
        
               ['label' => 'Все букеты', 'url' => ['site/allbukets']],
               "Поиск по фразе",
      ],
     ]);	
    $this->title = $idname; 
			 
		 }
		 else 
         {
	
	        echo Breadcrumbs::widget([
             'itemTemplate' => "<li>{link}</li>\n", // template for all links
              'links' => [
  
             'Все букеты',
           ],
          ]);	
	
          $this->title = "Все букеты";	
	
         }
     }

?>



<?php



 $st = Yii::getAlias('@web'); 
$base_str_to_ims = $st . "/uploads/";
?>

<?php 

$st_search = Url::to(['site/allbukets']);
if ($idcat > -1) // в контроллекре filtercontroller тоже задействовано
  {
    $st2 = Url::to(['site/allbukets', 'unioncat' => $idcat]);
  }
  else {
	  
	       if ($searchq === -1) {
			     $st2 = Url::to(['site/allbukets']);  
				 }
		   else
		       {
			  	 $st2 = Url::to(['site/allbukets', 'searchq' => $searchq]); 
		       }
          
  
  }
  
 
  
 ?>

<?   $form = ActiveForm::begin([
    'action' => $st2,
    'id' => 'myfilter-form',
    'options' => ['class' => 'form-inline myform'],
]) ?>

<?php



//echo "gfjfjf";
?>
<script> 
var str = "4 558 477";
var res = str.replace(/\s/g, ""); 
var kon = res.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');


// alert (kon); 
</script>
<?php // $st = Yii::getAlias('@web'); echo $st; ?>
<input type = "hidden" name = "address" value = "<?php echo $st2; ?>"    />
<input type = "hidden" name = "address_search" value = "<?php echo $st_search; ?>"    />
<?= $form->field($filterdata, 'categ', ['options' => ['class' => '', 'id' => 'idofcateg'], 'labelOptions' => ['class' => 'mylabelhidden']])->hiddenInput(['value' => $idcat]) ?>
<?= $form->field($filterdata, 'searchforaja', ['options' => ['class' => '', 'id' => 'searchforajaid'], 'labelOptions' => ['class' => 'mylabelhidden']])->hiddenInput(['value' => $searchq]) ?>
<div class="col-md-3 col-sm-4 col-sm-push-8 col-md-push-9 sidebar-offcanvas" id="sidebar">
   <div class="bx-sidebar-block">
	  <div class="row">
	   <div class="col-md-12 text-right visible-xs center-block" style="margin-bottom: 20px;">
		<button type="button" id = "showmyfilter" class="btn btn-warning btn-lg btn-block" style="margin-bottom: 15px;" data-toggle="offcanvas">Показать фильтр</button>
		<button type="button" id = "hidemyfilter" class="btn btn-warning btn-lg btn-block" style="margin-bottom: 15px;" data-toggle="offcanvas">Скрыть фильтр</button>
	   </div>
	  <div class="col-sm-12 tooglefilt">
		<a href="javascript:void(0)" onclick = "click_price(1)" class="btn btn-danger btn-md btn-block" style="margin-bottom: 10px;">до 2000 <i class="fa fa-rub"></i></a>
	  </div>
	  <div class="col-sm-12 tooglefilt">
		<a href="javascript:void(0)" onclick = "click_price(2)" class="btn btn-success btn-md btn-block" style="margin-bottom: 10px;">2000 - 4000 <i class="fa fa-rub"></i></a>
	  </div>
	  <div class="col-sm-12 tooglefilt">
		<a href="javascript:void(0)" onclick = "click_price(3)" class="btn btn-success btn-md btn-block" style="margin-bottom: 10px;">4000 - 6000 <i class="fa fa-rub"></i></a>
	   </div>
	  <div class="col-sm-12 tooglefilt">
	 
		<a href="<?php echo Url::to(['site/allbukets', 'unioncat' => 86]); ?>" class="btn btn-warning btn-md btn-block" style="margin-bottom: 20px;"><b>VIP</b></a>
	   </div>
      </div>
	  
	  
	  
	  
	  <div class="bx-filter bx-green tooglefilt">
	     <div class="bx-filter-section container-fluid">
		    <div class="row">
               <div class="col-lg-12 bx-filter-title">Подбор параметров</div>
            </div>
			<div class = "row">
			   <div class=" bx-filter-parameters-box bx-active" id = "filparbox1">
			   <div id="modef1" class="bx-filter-popup-result left" >
			      Выбрано:
                  <span class = "modef_num" id="modef_num">42</span>
                  <span class="arrow"></span>
                    <br>
                  <a href="javascript:void(0)" onclick = "SubmitMyFormBuk(0)" target="">Показать</a>
			   
			   
			   
			   </div>
			     <div class="bx-filter-parameters-box-title" onclick="hideFilter(1)"><span>Цена <i data-role="prop_angle" class="fa fa-angle-down"></i></span></div>
				 
			   
			   
			   
			   <div class="bx-filter-block" data-role="bx_filter_block">
			      <div class="row bx-filter-parameters-box-container">
				    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
					     <i class="bx-ft-sub">От (рублей)</i>
                         <div class="bx-filter-input-container">
						  <!--  <input id="arrFilter_P2_MIN" class="min-price" name="arrFilter_P2_MIN" value="1000" size="5" onkeyup="keyup1()" type="text">   -->
						 <?php $bbb = 1000; ?>
						 <?= $form->field($filterdata, 'price1', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MIN'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->price1, 'onkeyup' => 'keyup1()']) ?>
						 </div>
					
					
					</div>
					
					
					<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
										<i class="bx-ft-sub">До (рублей)</i>
										<div class="bx-filter-input-container">
											<?= $form->field($filterdata, 'price2', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MAX'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->price2, 'onkeyup' => 'keyup2()']) ?>
										</div>
					</div>
									
									
					<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">

					   <?php

                         echo "<div style = 'display: block; width: 100%; height: 100px; margin-top: 50px;'>";

                         echo Slider::widget([
                          'id' => 'slideyii1',
                          'clientOptions' => [
                            'range' => true,
                            'min' => 1000,
                            'max' => 6000,
	                        'values' => [$filterdata->price1, $filterdata->price2],
	
                           ],

                          'clientEvents' => [
                             'slide' => 'function( event, ui ) {ddd (event, ui) }',
	                         'change' => 'function( event, ui ) {filtaja_posr  (ui, 1) }',
                             ],

                           ]);
					
                        echo "</div>";					
					?>
					

                    </div>					
	  
				  </div>
  
			   </div>
			   
			  </div>
			  
			  
			<div class=" bx-filter-parameters-box" id = "filparbox2">
			   <div id="modef2" class="bx-filter-popup-result left" >
			      Выбрано:
                  <span class = "modef_num" id="modef_num">42</span>
                  <span class="arrow"></span>
                    <br>
                   <a href="javascript:void(0)" onclick = "SubmitMyFormBuk(0)" target="">Показать</a>
			   
			   
			   
			   </div>
			     <div class="bx-filter-parameters-box-title" onclick="hideFilter(2)"><span>Высота <i data-role="prop_angle" class="fa fa-angle-down"></i></span></div>
				 
			   
			   
			   
			   <div class="bx-filter-block" data-role="bx_filter_block">
			      <div class="row bx-filter-parameters-box-container">
				    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
					     <i class="bx-ft-sub">От (см.)</i>
                         <div class="bx-filter-input-container">
						  <!--  <input id="arrFilter_P2_MIN" class="min-price" name="arrFilter_P2_MIN" value="1000" size="5" onkeyup="keyup1()" type="text">   -->
						 <?php $bbb = 1000; ?>
						 <?= $form->field($filterdata, 'height1', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MINh'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->height1, 'onkeyup' => 'hkeyup1()']) ?>
						 </div>
					
					
					</div>
					
					
					<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
										<i class="bx-ft-sub">До (см.)</i>
										<div class="bx-filter-input-container">
											<?= $form->field($filterdata, 'height2', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MAXh'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->height2, 'onkeyup' => 'hkeyup2()']) ?>
										</div>
					</div>
									
									
					<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">

					   <?php

                          echo "<div style = 'display: block; width: 100%; height: 100px; margin-top: 50px;'>";

                          echo Slider::widget([
                            'id' => 'slideyii2',
                            'clientOptions' => [
                            'range' => true,
                            'min' => 40,
                            'max' => 100,
	                        'values' => [$filterdata->height1, $filterdata->height2],
	
                            ],

                            'clientEvents' => [
                              'slide' => 'function( event, ui ) {ddd2 (event, ui) }',
	                          'change' => 'function( event, ui ) {filtaja_posr  (ui, 2) }',
                             ],

                           ]);
					
                        echo "</div>";					
					?>
					

                    </div>					
	  
				  </div>
  
			   </div>
			   
			  </div>
			  
			  
			  
			  
			  
			  
				<div class=" bx-filter-parameters-box" id = "filparbox3">
			   <div id="modef3" class="bx-filter-popup-result left" >
			      Выбрано:
                  <span class = "modef_num" id="modef_num">42</span>
                  <span class="arrow"></span>
                    <br>
                  <a href="javascript:void(0)" onclick = "SubmitMyFormBuk(0)" target="">Показать</a>
			   
			   
			   
			   </div>
			     <div class="bx-filter-parameters-box-title" onclick="hideFilter(3)"><span>Ширина <i data-role="prop_angle" class="fa fa-angle-down"></i></span></div>
				 
			   
			   
			   
			   <div class="bx-filter-block" data-role="bx_filter_block">
			      <div class="row bx-filter-parameters-box-container">
				    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
					     <i class="bx-ft-sub">От (см.)</i>
                         <div class="bx-filter-input-container">
		
						   <?= $form->field($filterdata, 'width1', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MINw'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->width1, 'onkeyup' => 'wkeyup1()']) ?>
						 </div>
					</div>
					
					
					<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
						 <i class="bx-ft-sub">До (см.)</i>
						 <div class="bx-filter-input-container">
						   <?= $form->field($filterdata, 'width2', ['options' => ['class' => '', 'id' =>'arrFilter_P2_MAXw'], 'labelOptions' => ['class' => 'mylabelhidden']])->textInput(['value' => $filterdata->width2, 'onkeyup' => 'wkeyup2()']) ?>
						 </div>
					</div>
									
									
					<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">

					   <?php

                          echo "<div style = 'display: block; width: 100%; height: 100px; margin-top: 50px;'>";


                          echo Slider::widget([
                          'id' => 'slideyii3',
                          'clientOptions' => [
                          'range' => true,
                          'min' => 25,
                          'max' => 70,
	                      'values' => [$filterdata->width1, $filterdata->width2],
	
                           ],

                          'clientEvents' => [
                             'slide' => 'function( event, ui ) {ddd3 (event, ui) }',
	                         'change' => 'function( event, ui ) {filtaja_posr  (ui, 3) }',
                           ],

                          ]);
					
                        echo "</div>";					
					?>
					

                    </div>					
	  
				  </div>
  
			   </div>
			   
			  </div>  

			</div>
            <div class="row">
              <div class="col-xs-12 bx-filter-button-box">
                 <div class="bx-filter-block">
                     <div class="bx-filter-parameters-box-container">
                         <a href = "javascript:void(0)" id="set_filter" class="btn btn-success " style = "float: right;" name="set_filter"  type="button" onclick = "SubmitMyFormBuk(0)" > Показать </a>
                        

                     </div>
                 </div>
              </div>
            </div>
		 </div>
	  
	  </div>
	  
	 

   </div>


</div>

 

<div class="col-md-9 col-sm-8 col-sm-pull-4 col-md-pull-3">
	<div class="row">
	
	<?php   if (($searchq != -1) or isset($unioncatid) )  { 
     ?>   
	
	<div class="bx-title_div">
<h1 id="pagetitle" class="bx-title dbg_title"><?php 
    
	if (($searchq != -1))  { echo "Результаты поиска";     }
	else {
  
    if ($unioncatid == 1) { echo "Повод: ";}  
    if ($unioncatid == 3) { echo "Букеты: ";}
    if ($unioncatid == 2) { echo "Кому: ";}
    if ($unioncatid == 4) { echo "Эксклюзив: ";}
    echo $idname;      } 
      ?> </h1> 
</div>

<?php
	}
	?>
	<?= $form->field($filterdata, 'sort1', [ 'labelOptions' => ['class' => 'hidelabelmy']])->hiddenInput(['value' => $filterdata->sort1]);   ?>
  
	
	    <div class="col-xs-12">
		   <div class="row">
		   
		   <div class="col-md-12 hidden-xs" id = "greendrop" style = "margin-bottom: 50px;">
		      <div class="pull-left sort_name">Сортировать по</div>
			      <div class="pull-left sort_select1">
   					  <div class="dropdown">
                         <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class = ""> <?php
                                if ($filterdata->sort1 == 1) { echo "популярности (по убыванию)"; } 
                                if ($filterdata->sort1 == 2) { echo "цене (по возрастанию)"; } 
                                if ($filterdata->sort1 == 3) { echo "популярности (по возрастанию)"; } 
                                if ($filterdata->sort1 == 4) { echo "цене (по убыванию)"; } 
   
                            ?> </span>
                            <span class="fa fa-chevron-down greendropspan"></span>
                         </button>
                         <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                             <li class = "<?php if ($filterdata->sort1 == 1) echo ""; ?>"><a href="#" onclick = "fsort(event, 1)">Популярности (по убыванию)</a></li>
                             <li class = "<?php if ($filterdata->sort1 == 2) echo ""; ?>"><a href="#" onclick = "fsort(event, 2)">Цене (по возрастанию)</a></li>
	                         <li class = "<?php if ($filterdata->sort1 == 3) echo ""; ?>"><a href="#" onclick = "fsort(event, 3)">Популярности (по возрастанию)</a></li>
	                         <li class = "<?php if ($filterdata->sort1 == 4) echo ""; ?>"><a href="#" onclick = "fsort(event, 4)">Цене (по убыванию)</a></li>
                         </ul>
                      </div>
				  
				  </div>
		   
		   			      
		   </div>
		   
		   </div>
		   
		   <div class = "row listofbukets">
	
		   <?php $i = 0;
		   for ($i=0; $i<1; $i++) {  ?>
		     <?php $k = 0; ?>
		     <?php foreach ($buketi as $buk) 
                  {  $k++;   ?>
		  
			  <?php
			//  $pathim = $base_str_to_ims . $buk->pathim . "_thumb" . "." . $buk->extim;
			    $pathim = $base_str_to_ims . $buk->pathim . "." . $buk->extim;
			  ?>
			  <div class = "buket_parent">
			     <div class = "buket_parent2">
				 
		             <a id="bx_3966226736_7975_pict" class="foto_href onebukaja2" target = "_blank" href="<?php echo Url::to(['site/buketaja', 'id' => $buk->id]); ?>"  title="<?php echo $buk->name;?>">
		              
					  <img src = "<?php echo $pathim;?>" />
					 </a>
					 
					 <div class="buk_title">
					 <a class = "onebukaja2" target = "_blank" href="<?php echo Url::to(['site/buketaja', 'id' => $buk->id]); ?>" title="<?php echo $buk->name;?>"><?php echo $buk->name;?></a>
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
					            <a data-id = "<?php echo $buk->id;?>" data-type = "4" class="btn btn-success incart"  href="javascript:void(0)" rel = "nofollow">Купить</a>
				     </div> 
					 
					 
					 
				</div>	 
					 
					 <div style="clear: both;"></div>
					  
					  <div  data-id = "<?php echo $buk->id;?>" data-type = "7xx" class = "parent_incart parent_divspin">
					  <?php $st = Yii::getAlias('@web'); $st = $st . "/spinner.gif"?>
					            <img data-id = "<?php echo $buk->id;?>" data-type = "7" src = "<?php echo $st; ?>" />
				     </div> 
					 <div style="clear: both;"></div>
					 
					 <div class = "articuls_items">
					 
					    <ul class="list-inline hl_tooltip_li prop_li">
					     <?php if ($buk->height != NULL) { echo "<li><i class='fa fa-arrows-v'></i> ".$buk->height . " см</li>	"; }			
						  if ($buk->width != NULL) { echo "<li><i class='fa fa-arrows-h'></i> ". $buk->width  . " см</li>	"; } 			
						   if ($buk->fromcountry != NULL) { echo "<li><i class='fa fa-globe'></i> ". $buk->fromcountry  . "</li>	"; } 	
						   if ($buk->info != NULL) { echo "<li><i class='fa fa-info-circle'></i> ". "букет цветов"  . "</li>	"; }  ?>	
						  
				        </ul>
					 
					 
					 </div>
					 
					
				 
				 </div>
			  </div>
			  
			  <?php if ($k == 3) {   $k=0; ?>
			 <!-- <div class = "clearfix"></div>  -->
			    <?php } ?>
			  
			   <?php } ?>
			   
			   
			   
			   
			  <div class = "clearfix"></div>
			  
			 <?php } ?>
			  
			  
			  
			  
			  
			 
			  
			  <div class = "clearfix"></div>
			  
			  <!--
			  <div class = "buket_parent">
			     <div class = "buket_parent2">
				 
		             <a id="bx_3966226736_7975_pict" class="foto_href" href="/catalog/buket/bouquet-of-delicate-roses-pink-avalani/"  title="NGNNFFJF">
		                <img src = "/shop/basic/web/flow/1.jpg" />
					 </a>
					 
					 <div class="buk_title">
					 <a href="/catalog/buket/bouquet-of-delicate-roses-pink-avalani/" title="Букет нежных роз Пинк Аваланж">Букет нежных роз Пинк Аваланж</a>
                     </div>
					 
                     <div class = "buk_price">3 500 руб.</div>

				 
				 
				 </div>
			  </div>  -->
		   
			<div id = "specialurl" style = "display: none"><?php echo ("") ?> </div>
				 
		</div>
		
	</div>
	
	
</div>	
<div style = "text-align: center; margin-bottom: 100px;">
<?php
	echo LinkPager::widget([
    'pagination' => $pages,
]);   ?>
</div>
<?php ActiveForm::end() ?>


<script>

$(document).ready(init);
function init(){ $('.incart').on('click', myf);  
		 $('[data-type = 4]').on('click', ajaposr);
		  $('[data-type = 6]').on('click', ajaposr2);
		  $('.minusminus').on('click', ff2);
		  $('.plusplus').on('click', ff3);
		  $('.minusminus_mp').on('click', ff2_mp);
		  $('.plusplus_mp').on('click', ff3_mp);
		  $('[data-type = 2]').on('change', ff5);
		  
		  $('#hidemyfilter').on('click', hidefilterblock);
		  $('#showmyfilter').on('click', showfilterblock);
		  magnif_posr();
		   
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
		 
function filtaja_posr ($num, $por)
	  {
		 $addr = '<?php echo Url::to(['filter/index']); ?>'; 
		 filtaja ($num, $por, $addr);
	  }
	  
	  
	  
function  fsearch3up_posr()  
	 {
		 $addr = '<?php echo Url::to(['site/searchbuk']); ?>';
		 fsearch3up( $addr );
	 }

	 
function ajaposr () {
	//alert ("555");
	//v = $("[data-type = 4xx][data-id = 52]").html();
	//alert (v);
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
	
	//$('[data-type = 4]').on('click', ajaposr);
	//$("[data-type = '4test']").on('click', testf);
//	v = $("[data-type = 4xx][data-id = 52]").html();
//	alert (v);

	
}
	  
function testf ()
{
alert("333");
}	


	  
 

function myf() {
	
 ////////////////////////////
}


		</script> 
		<script>
						
					 



function SubmitMyFormBuk(par)	
{

    $sort = $('#filterdata-sort1').val();

	$p1 = $('#arrFilter_P2_MIN input').val();
    $p2 = $('#arrFilter_P2_MAX input').val();
    $p3 = $('#arrFilter_P2_MINh input').val();
	$p4 = $('#arrFilter_P2_MAXh input').val();
	$p5 = $('#arrFilter_P2_MINw input').val();
	$p6 = $('#arrFilter_P2_MAXw input').val();
	
	//$v = $('#myfilter-form').attr("action");
	if (par == 0)
	 $v = $("input[name='address']").val();  
    else 
     $v = $("input[name='address_search']").val();
	
	// alert ($v);
	$sort = Number($sort);
	$p1n = Number($p1);
	$p2n = Number($p2);
	$p3n = Number($p3);
	$p4n = Number($p4);
	$p5n = Number($p5);
	$p6n = Number($p6);
	
	//$('#myfilter-form').submit();
	var $f;
    $f = $v.indexOf('?');
	if ($f < 1)
	{   $v = $v + '?';   }
	else    {   $v = $v + '&';  }
	
	$flag_first = 0;
	
	if ($sort != 1)
	{  
       $flag_first = 1;
       $v = $v + "sort=" + $sort;  	
    
	}
	if ($p1n != 1000)
	{   
       if ($flag_first == 0) 
	    {  $v = $v + "price1=" + $p1;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&price1=" + $p1;     }
    }
	if ($p2n != 6000)
	{  
      if ($flag_first == 0) 
	    {  $v = $v + "price2=" + $p2;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&price2=" + $p2;     }
    }
    if ($p3n != 40)
	{  

       if ($flag_first == 0) 
	    {  $v = $v + "height1=" + $p3;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&height1=" + $p3;     }

    }
	if ($p4n != 100)
	{  
       if ($flag_first == 0) 
	    {  $v = $v + "height2=" + $p4;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&height2=" + $p4;     }

    }
	if ($p5n != 25)
	{   
       if ($flag_first == 0) 
	    {  $v = $v + "width1=" + $p5;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&width1=" + $p5;     }

    }
	if ($p6n != 70)
	{  

       if ($flag_first == 0) 
	    {  $v = $v + "width2=" + $p6;  $flag_first = 1;  }
	   else
	    {  $v = $v + "&width2=" + $p6;     }

    }
	
	
	
	$(location).attr('href', $v);
	
	
}

function click_search()    {
	
	$v = $("input[name='searchq']").val();
	$addr = $("input[name='address_search']").val();
	
	
	
	$addr = $addr + '?searchq=' + $v;
//	alert ($addr);
    $(location).attr('href', $addr);
	
}

function click_price(num)
 {
	if (num == 1) 
	 {
	 
      $('#arrFilter_P2_MAX input').val('2000');
	  $('#arrFilter_P2_MIN input').val('1000');
	 }
    if (num == 2) 
	 {
	  $('#arrFilter_P2_MIN input').val('2000');
      $('#arrFilter_P2_MAX input').val('4000');
	 }
	if (num == 3) 
	 {
	  $('#arrFilter_P2_MIN input').val('4000');
      $('#arrFilter_P2_MAX input').val('6000');
	 }
	 
	$('#arrFilter_P2_MINh input').val('40');
	$('#arrFilter_P2_MAXh input').val('100');
	$('#arrFilter_P2_MINw input').val('25');
	$('#arrFilter_P2_MAXw input').val('70');
	
	SubmitMyFormBuk(1);

 }




						
					//	$( ".selector" ).slider( "values", 0, 55 );
					


	  					
						</script>

<?php // $this->endCache();
// }