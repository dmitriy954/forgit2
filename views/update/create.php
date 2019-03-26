<?php
// тоже как посредник. все в _form
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */

$this->title = 'Создать букет';
$this->params['breadcrumbs'][] = ['label' => 'Букеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buketigii-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,  'rez' => $rez, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch,
    ]) ?>

</div>
