<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
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


<h2> Изменение  пароля </h2>

<h3> Введите новый пароль</h3>

<div> Ваш логин: <b><?php echo $name ?></b></div>

<div class = "container">

<?= $form->field($model, 'password')->passwordInput()->label('Пароль (не менее 6 символов)') ?>
<?= $form->field($model, 'passwordrep')->passwordInput()->label('Повторите пароль') ?>

<div class="form-group">
            <div class="">
                <?= Html::submitButton('Установить пароль', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
</div>


<?php ActiveForm::end() ?>
</div>