<?php
use yii\widgets\Breadcrumbs;
// echo (md5($model->password));
$this->title = 'Страница информации';
// $this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n", // template for all links
    'links' => [
        
        ['label' => 'Повторная отрпавка', 'url' => ['registr/rogeroncemore']],
        'Сообщение',
    ],
]);	

echo "<h2>";  echo $str;  echo "</h2>";