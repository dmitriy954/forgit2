<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buketigii-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'idcat1')->textInput() ?>

    <?= $form->field($model, 'idcat2')->textInput() ?>

    <?= $form->field($model, 'idcat3')->textInput() ?>

    <?= $form->field($model, 'idcat4')->textInput() ?>

    <?= $form->field($model, 'idcat5')->textInput() ?>

    <?= $form->field($model, 'idcat6')->textInput() ?>

    <?= $form->field($model, 'idcat7')->textInput() ?>

    <?= $form->field($model, 'pathim')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'extim')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
