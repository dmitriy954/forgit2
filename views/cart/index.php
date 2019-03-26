<?php
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->registerJsFile('@web/js/cart_index.js', ['depends' => [app\assets\AppAsset::className()]]); 

 $st = Yii::getAlias('@web'); 
$base_str_to_ims = $st . "/uploads/";
/*
echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n", // template for all links
    'links' => [
        
        
        'Корзина',
    ],
]);	
*/

$this->params['breadcrumbs'][] = 'Корзина';
?>

<div class="bx-title_div" style = "text-align: center">
<h1 id="pagetitle" class="bx-title dbg_title" style = "display: inline-block">Список заказанных товаров </h1>
</div>

<div id = "basket_item_list">
  <form id = "singleform" action="<?php echo Url::to(['cart/enterdata']) ?>"   method = "post"        >
  <input type="hidden" name="_csrf" value="QzB5eHYwX3I2YxYTT2UACAJaMSsmCBM0BGAxSBAAExU0VBsgIHgrJw==">
  <input type="hidden" name="totalinp" value = "<?php echo $total ?>">
  <!-- следующий инпут    -->
  <input type="hidden" name="strishodidkol" value = "<?php echo $strforjs ?>">
  <input type="hidden" name="iddel" value = "0">
  <input type="hidden" name="idadd" value = "0">
  
  <input data-type = "31"   name="listchange" value="5" type="hidden" >
    <div class = "order_table table-responsive">
        <table id="basket_items" class="table table-striped">
		   <thead>
				<tr>
												<th class="item" id="col_NAME" width="30%">
													Товары							</th>
												<th class="custom" id="col_DISCOUNT">
													Скидка							</th>
												<th class="price" id="col_PRICE">
													Цена							</th>
												<th class="custom" id="col_QUANTITY">
													Количество							</th>
												<th class="custom" id="col_SUM">
													Сумма							</th>
											<th class="custom"></th>
				</tr>
			</thead>
			
				<tbody>
				   <?php 
				     $i = 0;
				     foreach ( $mass_of_bukets as $elem )
					    {
				?>
				   
									<tr data-id="<?php echo $elem->id?>">
						<?php 
			  $pathim = $base_str_to_ims . $elem->pathim . "_thumb" . "." . $elem->extim;
			  ?>
								<td class="item product-in-table">
								<?php $st = Url::to(['site/buketaja', 'id' => $elem->id]) ?>
									<a href="<?php echo $st; ?>"  target = "_blank"><img class="img-responsive" src="<?php echo $pathim ?>" alt=""></a>
									<div class="product-it-in">
										<h3 class="bx_ordercart_itemtitle">
											<a href="<?php echo $st; ?>" target = "_blank"><?php echo $elem->name; ?></a>										</h3>
									</div>
								</td>
															<td class="custom">
									<div id="discount_value_6916">0%</div>
								</td>
															<td class="price">
										<div class="current_price" data-id="<?php echo $elem->id?>" data-type = "21"><?php $pr = $elem->price; $pr = number_format($pr, 0, '', ' '); $pr = $pr . " руб."; echo $pr; ?></div>
										<div class="old_price" id="old_price_6916"></div>

																	</td>
															<td class="custom">


																
									<div class="basket_quantity_control buk_spin buk_spin_vis">
										
										<div  class = "buk_spin_control minusminus" data-id = "<?php echo $elem->id?>">-</div>
						                <div class = "buk_spin_input">
						<input   data-id = "<?php echo $elem->id?>" data-type = "2"  class="buck_input_target" name="quantity" value="<?php echo $mass_of_kols[$i];?>" type="text" >
						                </div>
						                <div  class = "buk_spin_control plusplus" data-id = "<?php echo $elem->id?>">+</div>
									</div>

								
									<input id="QUANTITY_6916" name="QUANTITY_6916" value="1" type="hidden">
								</td>
															<td class="custom shop-red" >
															<?php  
															$sum = $mass_of_kols[$i] * $elem->price;  ?>
																			<div data-id = "<?php echo $elem->id?>" data-type = "11"><?php $sum = number_format($sum, 0, '', ' '); echo $sum; ?> руб.</div>
																	</td>
														<td class="control">
																	<a data-id = "<?php echo $elem->id?>" href="javascript:void(0)" onclick = "checkOutdel(<?php echo $elem->id ?>)">×</a><br>
															</td>
											</tr>
						<?php
                        $i = $i + 1;
						} ?>
									
								</tbody>
			
			
			
		</table>
    </div>
	
	
	
	<div class="ordercart_order_pay">
		<div class="row">
			<div class="bx_ordercart_order_pay_right col-sm-4 col-sm-offset-4">
				
					<ul class="list-inline total-result">
						<li>
							<h4>Товаров на:</h4>
							<div class="total-result-in" data-type = "12" id = "summoftov"><span><?php $total = number_format($total, 0, '', ' '); echo $total; ?></span>&nbsp;руб.</div>
						</li>
											<li class="divider"></li>
						<li class="total-price">
							<h4>Итого:</h4>
							<div class="total-result-in" data-type = "13"><span><?php echo $total; ?></span>&nbsp;руб.</div>
						</li>
					</ul>
				
					
				<a href="javascript:void(0)" onclick="checkOut();" class="checkout btn btn-warning btn-lg btn-block">Оформить заказ</a>

			</div>
		</div>
	</div>
	
	</form>
	
	
	
	<?php
 $st = Yii::getAlias('@web'); 
$base_str_to_ims = $st . "/uploads/";

    ?>
	<?php $i = 0; ?>
	<div class="product-list">
			  <div class="heading heading-v4">
<div class="h2 h3">Получателю букета может понравиться</div>
</div>
			  <ul>
			  
			  <?php foreach ($buketi as $buk) 
                  {  ?>
				  
				  <?php
			  $pathim = $base_str_to_ims . $buk->pathim . "_thumb" . "." . $buk->extim;
			  ?>
			  
		<li style=" opacity: 1;">
					
			<div class = "buket_parent_adj">
			    <div class = "buket_parent2">
					
					 <a id="bx_3966226736_7975_pict" class="foto_href" href="javascript:void(0)"  title="NGNNFFJF">
		              
					     <img src = "<?php echo $pathim;?>" />
					 </a>
					 
					 <div class="buk_title">
					    <?php echo $buk->name;?>
                     </div>
					 
					 <?php 
					 $buf = $buk->price;
					 $buf = number_format($buf, 0, '', ' '); ?>
                     <div class = "buk_price"><?php echo $buf;?> руб.</div>
					 
					 <div data-id = "<?php echo $buk->id;?>" data-type = "4xx"  class = "parent_incart_adj">
					 
					
					            <a data-id = "<?php echo $buk->id;?>" data-type = "adj4" class="btn btn-success incart"  href="javascript:void(0)" onclick="checkOutadd(<?php echo $buk->id;?>)" >Добавить</a>
				     </div> 

				
                </div> 
             </div>
				
			  </li> 
			 
			  <?php } ?>
								
								
								
								
											
			</ul>
		    </div>
	
</div>
	


<script>
$(document).ready(init);
		 function init(){ //$('.incart').on('click', myf);  
		// $('[data-type = 4]').on('click', aja);
		 // $('[data-type = 6]').on('click', aja2);
		  $('.minusminus').on('click', ff2_posr);
		  $('.plusplus').on('click', ff3_posr);
	
		  $('[data-type = 2]').on('change', ff5);
		 }	
		 
		 function ff2_posr ()
		 {
			$perr = $(this).attr("data-id"); 
			ff2($perr);
			 
			 
		 }
		 
		 function ff3_posr ()
		 {
			$perr = $(this).attr("data-id"); 
			ff3($perr);
			 
			 
		 }
		 
		 


				




						
function ff5()
						{
							var per, $perr, tekkol;
							var strishod, strchange;
							kolfrominput = $(this).val();
							tekkol = $(this).val();
							
							$perr = $(this).attr("data-id");
							
							changecolumnandtotal ($perr, kolfrominput);
                        
							

	
	 
							
						//	alert(per);
						}
						


function checkOut()
    {
		 $('#singleform').submit();
		
	
	
	
    }
	
function checkOutadd($id)
{
	// $perr = $(this).attr("data-id");
	// alert ($id);
	 $('input[name=idadd]').val($id);
	// $uu = $('input[name=idadd]').val();
	// alert($uu);
	 checkOut();
	
}

function checkOutdel($id)
{
	// $perr = $(this).attr("data-id");
	 $('input[name=iddel]').val($id);
	// alert ($id);
     checkOut();
	 
	 
}


						
</script>