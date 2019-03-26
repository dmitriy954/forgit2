<?php
use yii\widgets\Breadcrumbs;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n", // template for all links
    'links' => [
        
        ['label' => 'Корзина', 'url' => ['cart/index']],
        'Страница ошибки',
    ],
]);
echo "суммы не совпадают. вернитесь в корзину";