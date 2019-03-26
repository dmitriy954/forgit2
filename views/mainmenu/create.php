<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mainmenu */

$this->title = 'Create Mainmenu';
$this->params['breadcrumbs'][] = ['label' => 'Mainmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainmenu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
