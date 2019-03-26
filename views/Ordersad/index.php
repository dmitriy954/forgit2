<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    Статусы: 1 - наличные курьеру (в оплате не нуждается) 2 - в предварительной оплате нуждается, 3 - оплачен , 5 - заказ выполнен (закрыт)
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id:text:ID',
         //   'name:ntext',
         //   'mail:ntext',
         //   'mobile:ntext',
          //  'town:ntext',
            // 'street:ntext',
            // 'house:ntext',
            // 'kvoret:ntext',
            // 'datemy:ntext',
            // 'whentime:ntext',
            // 'mobileto:ntext',
            // 'textotkr:ntext',
            // 'dost',
			[
			'attribute'=>'oplata',
            'label'=>'Вид оплаты',
		/*	'content'=>function($data){ if ($data == 5)
				{ return "value"; } else { return $data; }  }  */
			'value' => function ($model, $_key, $_index, $_column) { 
			if ($model->oplata == 1)
			 return "банковские карты";
		    if ($model->oplata == 2)
			 return "наличные курьеру";
		    if ($model->oplata == 3)
			 return "оплата QIWI";
		    if ($model->oplata == 4)
			 return "мобильный телефон";
		    if ($model->oplata == 5)
			 return "электронные деньги";
		    if ($model->oplata == 6)
		 	 return "терминалы";
		    


			},
			],   
			
             
            // 'textcomment',
            // 'iduser',
             'totprice:text:Общая сумма',
            // 'payornot',
            // 'datez',
             'status:text:Статус',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
