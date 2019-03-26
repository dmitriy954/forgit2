<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

  

    

    <?= $form->field($model, 'totprice')->textInput()->label('Цена по заказу: ') ?>



   

    <?= $form->field($model, 'status')->textInput()->label('Статус: ') ?>
	<a id = "num1" href = "javascript:void(0)" style = "display: block; float: none; clear: both; margin-bottom: 10px;" onclick = "ff(5)">  Закрыть заказ (усановить статус 5)  </a>
	<a id = "num2" href = "javascript:void(0)" style = "display: block; float: none; clear: both; margin-bottom: 10px;" onclick = "ff(1)">  Заказ не нуждается в предварительной оплате (установить статус 1)  </a>
	<a id = "num3" href = "javascript:void(0)" style = "display: block; float: none; clear: both; margin-bottom: 10px;" onclick = "ff(3)">  Заказ был оплачен (усановить статус 3)  </a>
	<a id = "num4" href = "javascript:void(0)" style = "display: block; float: none; clear: both; margin-bottom: 10px;" onclick = "ff(2)">  Закрыть нуждается в оплате но не оплачен (усановить статус 2)  </a>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
	<a style = "font-size: 30px;" href="<?php echo Url::to(['ordersad/update2', 'id' => $model->id]); ?>"> Редактирование всех параметров </a>

</div>

<script>
function ff (x)
{
	
	
	$('input[name="Orders_upd[status]"]').val(x);
	
}


</script>
