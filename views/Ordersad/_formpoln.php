<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6])->label('Имя: ') ?>

    <?= $form->field($model, 'mail')->textarea(['rows' => 6])->label('Е-майл: ') ?>

    <?= $form->field($model, 'mobile')->textarea(['rows' => 6])->label('Мобильный: ') ?>

    <?= $form->field($model, 'town')->textarea(['rows' => 6])->label('Город: ') ?>

    <?= $form->field($model, 'street')->textarea(['rows' => 6])->label('Улица: ') ?>

    <?= $form->field($model, 'house')->textarea(['rows' => 6])->label('Дом: ') ?>

    <?= $form->field($model, 'kvoret')->textarea(['rows' => 6])->label('Квартира: ') ?>

    <?= $form->field($model, 'datemy')->textarea(['rows' => 6])->label('Дата: ') ?>

    <?= $form->field($model, 'whentime')->textarea(['rows' => 6])->label('Доставка время: ') ?>

    <?= $form->field($model, 'mobileto')->textarea(['rows' => 6])->label('Мобильный2: ') ?>

    <?= $form->field($model, 'textotkr')->textarea(['rows' => 6])->label('Текст открытки: ') ?>

    <?= $form->field($model, 'dost')->textInput()->label('Доставка или вывоз: ') ?>

    <?= $form->field($model, 'oplata')->textInput()->label('Оплата: ') ?>

    <?= $form->field($model, 'textcomment')->textInput()->label('Коммент: ') ?>

    <?= $form->field($model, 'iduser')->textInput()->label('Ид клиента: ') ?>

    <?= $form->field($model, 'totprice')->textInput()->label('Цена: ') ?>



    <?= $form->field($model, 'datez')->textInput()->label('Дата: ') ?>

    <?= $form->field($model, 'status')->textInput()->label('Статус: ') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
