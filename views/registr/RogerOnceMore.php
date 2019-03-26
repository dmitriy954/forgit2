<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Повторная отправка письма';
$this->params['breadcrumbs'][] = $this->title;


?>


 <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
		'options' => ['class' => 'registr'],
        'fieldConfig' => [
            'template' => "{label}\n<div >{input}</div>\n<div >{error}</div>",
            'labelOptions' => ['class' => ' control-label'],
        ],
    ]); ?>


<h2> Повторная отпрака письма для подтверждения регистрации </h2>

<h3> Введите ваш логин или е-майл (что-то одно из двух) которые вы указывали при регистрации</h3>



<div class = "container">

<?= $form->field($model, 'loginoremail')->textInput()->label('Логин или е-майл') ?>


<div class="form-group">
            <div class="">
                <?= Html::submitButton('Получить письмо', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
</div>


<?php ActiveForm::end() ?>
</div>