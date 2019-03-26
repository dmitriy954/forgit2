<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MainMenu;

/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */
/* @var $form yii\widgets\ActiveForm */
?>
<?



// далее формируем массивы категорий для чекбоксов (ид категории, имя категории)
// сюда мы передавали 4 массива с категориями четырех основных категорий
// каждый элемент массива - это массив из двух элементов (ид категории и имя категории)

// но для чекбоксов нужен ассоцитивный массив ($name => $value) где name это id категории a value имя категории
// далее мы и формируем 4 таких массива для 4 чекбоксов
$items = NULL;
foreach ($rez as $buf)
{
	
	$b = $buf['id']; $b2 = $buf['name'];
	$items[$b] = $b2;  // добавляем элемент в массив, но через прямое указание. указываем имя элемента и значение
		
}
$items2 = NULL;
foreach ($rez2 as $buf2)
{
	
	$b = $buf2['id']; $b2 = $buf2['name'];
	$items2[$b] = $b2;
		
}
$items3 = NULL;
foreach ($rez3 as $buf3)
{
	
	$b = $buf3['id']; $b2 = $buf3['name'];
	$items3[$b] = $b2;
		
}
$items4 = NULL;
foreach ($rez4 as $buf4)
{
	
	$b = $buf4['id']; $b2 = $buf4['name'];
	$items4[$b] = $b2;
		
}




?>

<?

// какие-то категории главных четырех категории в букете установлены. нам нужно получить списки идов установленных категорий


// итак, у нас 4 списка. в каждом преобразованный в строку массив с идами отмеченных категорий.
// для избежание ошибки проверяем пустые или нет массивы, точнее строки из соновного модела. мы берем строки из основного модела и разбиваем в массив


$mass_ids_cats1 = []; $mass_ids_cats2 = []; $mass_ids_cats3 = []; $mass_ids_cats4 = [];

if ($model->strcat1) {
	   $str = $model->strcat1;
	   $mass_ids_cats1 = explode (";", $str);     }
   
if ($model->strcat2) {
	   $str = $model->strcat2;
	   $mass_ids_cats2 = explode (";", $str);  }
   
if ($model->strcat3)  {
	   $str = $model->strcat3;
	   $mass_ids_cats3 = explode (";", $str);  }
	   
if ($model->strcat4)  {
	   $str = $model->strcat4;
	   $mass_ids_cats4 = explode (";", $str);  }
   
// далее просто приравняв мы получим выделение элементов по переданным массивам идов 
   


 $massch->masscat1 = $mass_ids_cats1; 
 $massch->masscat2 = $mass_ids_cats2; 
 $massch->masscat3 = $mass_ids_cats3; 
 $massch->masscat4 = $mass_ids_cats4; 
 $model->info = 1;
 $model->fromcountry  = 'Нидерланды';
 $model->adjunct = 0;


?>
<div class="buketigii-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name', ['options' => ['class' => 'maxwidth300']])->textarea(['rows' => 6])->label('Название букета')?>

    <?= $form->field($model, 'price', ['options' => ['class' => 'maxwidth300']])->textInput()->label('Цена в рублях') ?>
	<?= $form->field($massch, 'masscat1', ['labelOptions' => ['class' => 'checklistlannnbel']])->checkboxList($items,['separator' => '<span style = "margin-left: 15px"> </span>', 'class' => "checklistlabel"])->label('Поводы')  ?>
	<?= $form->field($massch, 'masscat2')->checkboxList($items2,['separator' => '<span style = "margin-left: 15px"> </span>', 'class' => "checklistlabel"])->label('Кому букет')  ?>
	<?= $form->field($massch, 'masscat3')->checkboxList($items3,['separator' => '<span style = "margin-left: 15px"> </span>', 'class' => "checklistlabel"])->label('Вид букета')  ?>
	<?= $form->field($massch, 'masscat4')->checkboxList($items4,['separator' => '<span style = "margin-left: 15px"> </span>', 'class' => "checklistlabel"])->label('Эксклюзивные категории')  ?>
	<div style = "margin-bottom: 20px; "> Далее можно добавить от 1 до 5 изображений товара. Первое изображение является главным изображением. Его пользователь по умолчанию
	будет видеть крупным планом. Для нормального отображения каталога товаров соотношения длины и высоты всех изображений должны быть равны. В даном примере 
    это соотношение равно 1. То есть у всех загружаемых изображений ширина и высота должны быть равны. 	</div>
	<?= $form->field($massch, 'im1')->fileInput()->label('Изображение букета №1') ?>
	<? if (isset ($modelims) and $modelims and (strlen ($modelims->pathim1) > 2)) { 
	echo "ниже показано текущее изображение. Вы можете загрузить другое изображение, которое после сохранения изменений заменит текущее";
	$stal = Yii::getAlias('@web'); 
	$base_str_to_ims = $stal . "/uploads/";
	$pathim = $base_str_to_ims . $modelims->pathim1 . "." . $modelims->extim1;  ?>
	<div id ="im1">
	<img style = "display: block; width: 200px; height: 200px;" src =  "<?php echo $pathim ?>" >
	</div>
	<?php }  ?>
	
	
	<?= $form->field($massch, 'im2')->fileInput()->label('Изображение букета №2') ?>
	
	<? if (isset ($modelims) and $modelims and (strlen ($modelims->pathim2) > 2)) { 
	echo "ниже показано текущее изображение. Вы можете загрузить другое изображение, которое после сохранения изменений заменит текущее";
	$stal = Yii::getAlias('@web'); 
	$base_str_to_ims = $stal . "/uploads/";
	$pathim = $base_str_to_ims . $modelims->pathim2 . "." . $modelims->extim2;  ?>
	<div id ="im1">
	<img style = "display: block; width: 200px; height: 200px;" src =  "<?php echo $pathim ?>" >
	</div>
	<?php }  ?>
	
	<?= $form->field($massch, 'im3')->fileInput()->label('Изображение букета №3') ?>
	<? if (isset ($modelims) and $modelims and (strlen ($modelims->pathim3) > 2)) { 
	echo "ниже показано текущее изображение. Вы можете загрузить другое изображение, которое после сохранения изменений заменит текущее";
	$stal = Yii::getAlias('@web'); 
	$base_str_to_ims = $stal . "/uploads/";
	$pathim = $base_str_to_ims . $modelims->pathim3 . "." . $modelims->extim3;  ?>
	<div id ="im1">
	<img style = "display: block; width: 200px; height: 200px;" src =  "<?php echo $pathim ?>" >
	</div>
	<?php }  ?>
	<?= $form->field($massch, 'im4')->fileInput()->label('Изображение букета №4') ?>
	
	<? if (isset ($modelims) and $modelims and (strlen ($modelims->pathim4) > 2)) { 
	echo "ниже показано текущее изображение. Вы можете загрузить другое изображение, которое после сохранения изменений заменит текущее";
	$stal = Yii::getAlias('@web'); 
	$base_str_to_ims = $stal . "/uploads/";
	$pathim = $base_str_to_ims . $modelims->pathim4 . "." . $modelims->extim4;  ?>
	<div id ="im4">
	<img style = "display: block; width: 200px; height: 200px;" src =  "<?php echo $pathim ?>" >
	</div>
	<?php }  ?>
	
	<?= $form->field($massch, 'im5')->fileInput()->label('Изображение букета №5') ?>
	
	<? if (isset ($modelims) and $modelims and (strlen ($modelims->pathim5) > 2) ) { 
	echo "ниже показано текущее изображение. Вы можете загрузить другое изображение, которое после сохранения изменений заменит текущее";
	$stal = Yii::getAlias('@web'); 
	$base_str_to_ims = $stal . "/uploads/";
	$pathim = $base_str_to_ims . $modelims->pathim5 . "." . $modelims->extim5;  ?>
	<div id ="im1">
	<img style = "display: block; width: 200px; height: 200px;" src =  "<?php echo $pathim ?>" >
	</div>
	<?php }  ?>
	
    <?= $form->field($model, 'width', ['options' => ['class' => 'maxwidth300']])->textInput()->label('Введите ширину букета (от 25 до 70 см.)') ?>
	<?= $form->field($model, 'height', ['options' => ['class' => 'maxwidth300']])->textInput()->label('Введите высоту букета (от 40 до 100 см.)') ?>
	<?= $form->field($model, 'fromcountry', ['options' => ['class' => 'maxwidth300']])->textInput()->label('Из какой страны или города букет') ?>
    <?= $form->field($model, 'info', ['options' => ['class' => 'maxwidth300']])->dropdownList([
        1 => 'букет цветов', 
        2 => 'корзина цветов',
		3 => 'монобукет',
    ], ['prompt'=>'Select Category']  )->label('Тип букета');  ?>
	<?= $form->field($model, 'adjunct', ['options' => ['class' => 'maxwidth300']])->dropdownList([
        0 => 'основной товар', 
        1 => 'товар приложение',
		
    ], ['prompt'=>'Select Category']  )->label('Основной букет или дополнительный к букету товар');  ?>

    <div class="form-group" style = "margin-top: 20px;">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
