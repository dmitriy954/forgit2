<?php
// это просто посредник. все в _form
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */

$this->title = 'Обновить товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="buketigii-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model, 'modelims' => $modelims, 'rez' => $rez, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch,
    ]) 
	
	?>

</div>
