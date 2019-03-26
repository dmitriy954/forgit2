<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mail') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'house') ?>

    <?php // echo $form->field($model, 'kvoret') ?>

    <?php // echo $form->field($model, 'datemy') ?>

    <?php // echo $form->field($model, 'whentime') ?>

    <?php // echo $form->field($model, 'mobileto') ?>

    <?php // echo $form->field($model, 'textotkr') ?>

    <?php // echo $form->field($model, 'dost') ?>

    <?php // echo $form->field($model, 'oplata') ?>

    <?php // echo $form->field($model, 'textcomment') ?>

    <?php // echo $form->field($model, 'iduser') ?>

    <?php // echo $form->field($model, 'totprice') ?>

 

    <?php // echo $form->field($model, 'datez') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
