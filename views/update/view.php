<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buketigii-view">

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
            'id:text:Ид',
            'name:ntext:Название',
            'price:ntext:Цена',
            'strcat1:ntext:Коды категорий 1',
            'strcat2:ntext:Коды категорий 2',
            'strcat3:ntext:Коды категорий 3',
            'strcat4:ntext:Коды категорий 4',
            'width:ntext:Ширина',
			'height:ntext:Высота',
			'fromcountry:ntext:Страна',
			'info:ntext:Инфо',
            'pathim:ntext:Путь к файлу',
            'extim:ntext:Расширение файла',
        ],
    ]) ?>

</div>
