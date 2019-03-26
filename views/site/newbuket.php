
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$items = NULL;
foreach ($rez as $buf)
{
	
	$b = $buf['id']; $b2 = $buf['name'];
	$items[$b] = $b2;
		
}
$items2 = NULL;
foreach ($rez2 as $buf2)
{
	
	$b = $buf2['id']; $b2 = $buf2['name'];
	$items2[$b] = $b2;
		
}
$form = ActiveForm::begin([
    'id' => 'newbuketform',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'price') ?>
    <?= $form->field($model, 'maincat[]')->checkboxList($items)  ?>
	<?= $form->field($model, 'maincat2[]')->checkboxList($items2)  ?>
	<?= $form->field($model, 'im')->fileInput() ?>
    <div class="form-group">
        <div class="">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
<?php
foreach ($rez as $buf)
{
	echo $buf['id'];
	echo " ";
	echo $buf['name'];
	echo " ";
	$b = $buf['id']; $b2 = $buf['name'];
	$items[$b] = $b2;
		
}
echo "<br>_______________________________________________<br>";
foreach ($rez2 as $buf2)
{
	echo $buf2['id'];
	echo " ";
	echo $buf2['name'];
	echo " ";
		
}
echo "<br>_______________________________________________<br>";
foreach ($items as $key => $val)
{
	echo $key;
	echo " ";
	echo $val;
	echo " ";
}
