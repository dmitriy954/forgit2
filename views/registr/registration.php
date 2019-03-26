<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>

<?   $form = ActiveForm::begin([
    'id' => 'login-form',

	'options' => ['class' => 'registr'],
	'layout' => 'horizontal',
	'fieldConfig' => [
            'template' => "{label}\n<div>{input}</div>\n<div class = 'wwwwwwwwwwww'>{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
]) ?>

<div class = "container">
 <h2 style = "margin-bottom: 50px;">Регистрация</h2>
 <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Имя') ?>
 <?= $form->field($model, 'surname')->textInput()->label('Фамилия') ?>
 <?= $form->field($model, 'login')->textInput(['onkeyup' => 'keyupreg()'])->label('Логин') ?>
 <div>
    <div id = "uniqlog" class=" " style = "color: #a94442;"></div>
</div>
 <?= $form->field($model, 'email')->input('email')->label('Е-майл') ?>
 <?= $form->field($model, 'password')->passwordInput()->label('Пароль (не менее 6 символов)') ?>
 <?= $form->field($model, 'passwordrep')->passwordInput()->label('Повторите пароль') ?>
 <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
    // configure additional widget properties here
])->label('Введите текст с картинки. Для смены картинки нажмите на картинку') ?>

 

 
       
        <div class="form-group">
            <div class="">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
        </div>
</div>


<?php ActiveForm::end() ?>


<script> 

function keyupreg()
{
	$per = $('#registration-login').val();
	//alert($per);
	$per = String($per);
	$.ajax({
	
	
	type: "POST",
	        url:   '<?php echo Url::to(['registr/reviselog']); ?>',
        
            data: 'vallog=' + $per,
	
   
	
    complete: function(jqXHR, textStatus) {
		// alert (textStatus);
        if (textStatus == 'success') { 
		 
		  resp = jqXHR.responseText;
		  if ($per.length > 2)
		  {
	          if (resp == "0")
		        $('#uniqlog').html("<span style = 'color: green'>Введенный логин свободен</span>");
		      if (resp == "1")
			    $('#uniqlog').html("Этот логин занят, введите другой");
		  }
		  else
			  $('#uniqlog').html("");
		
		//  alert (resp);
		
		  
		 
		
			
        }
        if (textStatus == 'error') {
            alert('Ошибка.');
        }
    }
});
	
}


</script>