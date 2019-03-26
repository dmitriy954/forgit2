<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>Авторизация</h1>

    <p>Введите логин и пароль:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
		'options' => ['class' => 'registr'],
        'fieldConfig' => [
            'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
            'labelOptions' => ['class' => ' control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username', ['options' => ['class' => 'nomarg']])->textInput(['autofocus' => true])->label('Логин') ?>

        <?= $form->field($model, 'password', ['options' => ['class' => 'nomarg']])->passwordInput()->label('Пароль') ?>

        <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'nowidth200']])->checkbox([
            'template' => "<div>{input} {label}</div>\n<div>{error}</div>",
        ])->label('Запомнить меня') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
	
	
	<noindex>
     <div class="bx-authform-link-container"> 
       <a href="<?php echo Url::to(['registr/givemepass']) ?>" rel="nofollow">
          <b>Забыли свой пароль?</b>
       </a>
     </div>
    </noindex>
	
	<noindex>
     <div class="bx-authform-link-container"> 
       <a href="<?php echo Url::to(['registr/rogeroncemore']) ?>" rel="nofollow">
          <b>Выслать еще раз письмо для потверждения регистрации?</b>
       </a>
     </div>
    </noindex>
	
	
	<noindex>
	   <div class="bx-authform-link-container">
          Если вы впервые на сайте, заполните, пожалуйста, регистрационную форму.
          <br>
           <a href="<?php echo Url::to(['registr/registration']) ?>" rel="nofollow">
              <b>Зарегистрироваться</b>
           </a>
       </div>
    </noindex>
  <!--  <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>   -->
</div>
