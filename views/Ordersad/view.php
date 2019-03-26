<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Buketi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

 $st = Yii::getAlias('@web'); 
$base_str_to_ims = $st . "/uploads/";

?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:ntext',
            'name:ntext:имя',
            'mail:ntext:е-майл',
            'mobile:ntext:телефон',
            'town:ntext:город',
            'street:ntext:улица',
            'house:ntext:дом',
            'kvoret:ntext:квартира',
            'datemy:ntext:дата доставки',
            'whentime:ntext:время доставки',
            'mobileto:ntext:телефон2',
            'textotkr:ntext:открытка',
            'dost:ntext:доставка',
            'oplata:ntext:оплата',
            'textcomment:ntext:текст комментария',
            'iduser:ntext:Ид клиента',
            'totprice:ntext:общая стоимость',
            
            'datez:ntext:дата',
            'status:ntext:статус',
        ],
    ]) ?>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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
					  } } ?>
									
								</tbody>
			
			
			
		</table>
    </div>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>
