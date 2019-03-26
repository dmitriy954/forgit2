<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MainmenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mainmenus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainmenu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mainmenu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'id_cat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
