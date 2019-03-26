<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuketigiiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buketigii-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'idcat1') ?>

    <?= $form->field($model, 'idcat2') ?>

    <?php // echo $form->field($model, 'idcat3') ?>

    <?php // echo $form->field($model, 'idcat4') ?>

    <?php // echo $form->field($model, 'idcat5') ?>

    <?php // echo $form->field($model, 'idcat6') ?>

    <?php // echo $form->field($model, 'idcat7') ?>

    <?php // echo $form->field($model, 'pathim') ?>

    <?php // echo $form->field($model, 'extim') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
