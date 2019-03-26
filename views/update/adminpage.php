<?php

use yii\helpers\Url;
?>

<h2>Страница администратора </h2>

<div style = "margin-top: 50px; font-size: 20px;"><a href = "<?php echo Url::to(['update/index']) ?>"> Добавление, редактирование и удаление товаров </a></div>

<div style = "margin-top: 50px; font-size: 20px;"><a href = "<?php echo Url::to(['ordersad/index']) ?>"> Просмотр и редактирование заказов </a></div>
