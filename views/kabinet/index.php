<?php
use yii\db\ActiveRecord;
use app\models\Buketi;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'Личный кабинет';
?>

<?php $st = Yii::getAlias('@web'); 
$base_str_to_ims = $st . "/uploads/";
?>

<div class = "kabinet">
   <h2 style = "">Личный кабинет</h2>
   <div class = "mydivider"></div>
   <h3 style = "text-align: center; font-weight: bold;">Ваши текущие заказы</h3>
   
   
  
  <?php 
  $ikab = 0;
  
  if (is_array ($orders_tek) && count($orders_tek) > 0)   {
  foreach ($orders_tek as $order)
    {
		echo "<h3 style = 'color: green; margin-top: 70px;'>Ваш заказ № "; echo $order->id; echo " <span style = 'color: #000'> принят и поступил в обработку</span></h3>";
		$buks_of_order = $mass_buks_of_order[$ikab]; $ikab++;?>
		
		<?php if ($order->oplata != 2 ) // проверить соответствие типов и возможность сравнения по типам
		{ ?>
		
      <div class="ordercart_order_pay">
		<div class="row">
		 <div class = "mar50gkab"> </div>
		   <?php if ($order->status == 2 ) 
		    {  ?>
		  <h4 style = "text-align: center">Ваш заказ №<?php echo " "; echo $order->id; ?> нуждается в оплате</h4>
			<div class="bx_ordercart_order_pay_right col-sm-4 col-sm-offset-4">
				
					
				
					
				<a href="<?php echo Url::to(['cart/payemulate', 'id' => $order->id]) ?>"  class="checkout btn btn-warning btn-lg btn-block">Оплатить заказ</a>
                
			</div>
			
			<?php } 

				if ($order->status == 3) { ?>
			<h4 style = "text-align: center">Ваш заказ №<?php echo " "; echo $order->id; ?> успешно оплачен!</h4>
			<?php } ?>
			
			<?php  

				if ($order->status == 1) { ?>
			<h4 style = "text-align: center">Ваш заказ №<?php echo " "; echo $order->id; ?> находится в обработке</h4>
			<?php } ?>
			
			<div class = "mar50gkab"> </div>
			
		</div>
	</div>
	  
		<?php } ?>
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
					  if (is_array ($buks_of_order) && count($buks_of_order) > 0)   {
				     foreach ( $buks_of_order as $elem )
					    {
							$idb = $elem->id_buk;
							$buket_elem = Buketi::findOne($idb);
				?>
				   
									<tr >
						<?php 
			  $pathim = $base_str_to_ims . $buket_elem->pathim . "_thumb" . "." . $buket_elem->extim;
			  ?>
								<td class="item product-in-table">
									<a href="<?php echo Url::to(['site/buketaja', 'id' => $elem->id_buk]) ?>" target = "_blank"><img class="img-responsive" src="<?php echo $pathim ?>" alt=""></a>
									<div class="product-it-in">
										<h3 class="bx_ordercart_itemtitle">
										
										
											<a href="<?php echo Url::to(['site/buketaja', 'id' => $elem->id_buk]) ?>" target = "_blank"><?php echo $buket_elem->name; ?></a>										</h3>
									</div>
								</td>
															<td class="custom">
									<div id="discount_value_6916">0%</div>
								</td>
															<td class="price">
										<?php  $pr = number_format($totprice, 0, '', ' ');   ?>
										<div class="current_price"  data-type = "21"><?php echo $pr; ?></div>
										<div class="old_price" id="old_price_6916"></div>

																	</td>
															<td class="custom">
                                                               <?php echo $elem->kol; ?>

								                            </td>
															<td class="custom shop-red" >
															<?php  
															$sum = $elem->kol * $elem->price;  ?>
															<?php  $pr = number_format($sum, 0, '', ' ');   ?>
																			<div data-id = "<?php echo $elem->id?>" data-type = "11"><?php echo $pr; ?> руб.</div>
																	</td>
														
											</tr>
						<?php
                       // $i = $i + 1;
					  } } ?>
									
								</tbody>
			
			
			
		</table>
    </div>
	
	<div class="ordercart_order_pay">
		<div class="row">
			<div class="bx_ordercart_order_pay_right col-sm-4 col-sm-offset-4">
				
					<ul class="list-inline total-result">
						<li>
							<h4>Товаров на:</h4>
							<?php  $pr = number_format($order->totprice, 0, '', ' ');   ?>
							<div class="total-result-in" data-type = "12" id = "summoftov"><span><?php echo $pr; ?></span>&nbsp;руб.</div>
						</li>
											<li class="divider"></li>
						<li class="total-price">
							<h4>Итого:</h4>
							<?php  $pr = number_format($order->totprice, 0, '', ' ');   ?>
							<div class="total-result-in" data-type = "13"><?php echo $pr; ?>&nbsp;руб.</div>
						</li>
					</ul>
				<?php if ($order->status == 2) // проверить соответствие типов и возможность сравнения по типам
		{ ?>
					
				<a href="<?php echo Url::to(['cart/payemulate', 'id' => $order->id]) ?>"  class="checkout btn btn-warning btn-lg btn-block">Оплатить заказ</a>
		<?php } ?>
			</div>
		</div>
	</div>
   <div class = "mydividerbold"></div>
	<?php } } else { echo "<div style = 'font-size: 16 px; font-weight: bold; margin-bottom: 70px;'>текущих заказов нет</div>"; }?>
   
    <h3 style = "text-align: center; font-weight: bold;">Ваша корзина</h3>
	
	<?php if ($havekorz == 1)
	   {
		  echo "<div style = 'font-size: 16 px; font-weight: bold; margin-bottom: 70px;'>В вашей корзине есть товары. </div>"; 
		  ?>
		
<div style = "margin-top: 20px;"><a class="btn btn-primary incart" data-id="37" data-type="5" href="<?php echo Url::to(['cart/index']) ?>
" rel="nofollow"> Перейти в корзину </a></div>

	<?php	  
  
	   }
       else {  echo "<div style = 'font-size: 16 px; font-weight: bold; margin-bottom: 70px;'>Ваша корзина пуста.</div>";   }
   
   ?>
   
   
   
     <h3 style = "text-align: center; font-weight: bold; margin-top: 50px;">Ваши прошлые заказы</h3> 
	 
	
  <?php 
  $ikab = 0;
  if (is_array ($orders_pro) && count($orders_pro) > 0)   {
  foreach ($orders_pro as $order)
    {
		echo "<h3 style = 'color: green; margin-top: 70px;'>Заказ № "; echo $order->id; echo " <span style = 'color: #000'> , дата: "; echo $order->datez; echo "</span></h3>";
		$buks_of_order = $mass_buks_of_order_pro[$ikab]; $ikab++;?>
		
		
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
					  if (is_array ($buks_of_order) && count($buks_of_order) > 0)   {
				     foreach ( $buks_of_order as $elem )
					    {
							$idb = $elem->id_buk;
							$buket_elem = Buketi::findOne($idb);
				?>
				   
									<tr >
						<?php 
			  $pathim = $base_str_to_ims . $buket_elem->pathim . "_thumb" . "." . $buket_elem->extim;
			  ?>
								<td class="item product-in-table">
									<a href="<?php echo Url::to(['site/buketaja', 'id' => $elem->id_buk]) ?>" target = "_blank"><img class="img-responsive" src="<?php echo $pathim ?>" alt=""></a>
									<div class="product-it-in">
										<h3 class="bx_ordercart_itemtitle">
											<a href="<?php echo Url::to(['site/buketaja', 'id' => $elem->id_buk]) ?>" target = "_blank"><?php echo $buket_elem->name; ?></a>										</h3>
									</div>
								</td>
															<td class="custom">
									<div id="discount_value_6916">0%</div>
								</td>
															<td class="price">
										<?php  $pr = number_format($elem->price, 0, '', ' ');   ?>					
										<div class="current_price"  data-type = "21"><?php echo $pr; ?></div>
										<div class="old_price" id="old_price_6916"></div>

																	</td>
															<td class="custom">
                                                               <?php echo $elem->kol; ?>

								                            </td>
															<td class="custom shop-red" >
															<?php  
															$sum = $elem->kol * $elem->price;  ?>
															<?php  $pr = number_format($sum, 0, '', ' ');   ?>
																			<div data-id = "<?php echo $elem->id?>" data-type = "11"><?php echo $pr; ?> руб.</div>
																	</td>
														
											</tr>
						<?php
                       // $i = $i + 1;
					  }  }?>
									
								</tbody>
			
			
			
		</table>
    </div>
	

   <div class = "mydividerbold"></div>
	<?php } } else { echo "<div style = 'font-size: 16 px; font-weight: bold; margin-bottom: 70px;'>прошлых заказов нет</div>"; }?>

















	
   
</div>
  