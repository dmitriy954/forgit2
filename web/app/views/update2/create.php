<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Buketigii */

$this->title = 'Create Buketigii';
$this->params['breadcrumbs'][] = ['label' => 'Buketigiis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buketigii-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
