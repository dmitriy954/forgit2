<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восттавновление данных';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class = "container">
<?   $form = ActiveForm::begin([
    'id' => 'login-form',

	'options' => ['class' => 'registr'],
	'layout' => 'horizontal',
	'fieldConfig' => [
            'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
]) ?>
<div class = "row">
<h2> Запрос пароля </h2>
<?php if ($flag == 3) {  ?>
<div class="alert alert-danger">
      Логин или EMail не найдены.
     <br>
</div>
<?php }   ?>
<h3> Выслать код подтверждения </h3>

<p style = "color: #5a6c77; font-size: 13px; padding-bottom: 2px;">Если вы забыли пароль, введите логин или E-Mail. Контрольная строка для смены пароля, 
а также ваши регистрационные данные, будут высланы вам по E-Mail.</p>
</div>
<?= $form->field($model, 'loginoremail')->textInput(['autofocus' => true])->label('Логин') ?>

<div class="form-group">
            <div class="">
                <?= Html::submitButton('Выслать письмо', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
</div>


<?php ActiveForm::end() ?>
</div>