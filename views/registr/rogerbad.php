<?php

// echo (md5($model->password));
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

if ($f == 1)
 echo "<h2>Регистрация была уже ранее подтверждена. Вы можете авторизоваться на сайте</h2>";
else
 echo "<h2>Регистрация не подтверждена. Такой контрольной строки не найдено. Свяжитесь пожалуста с нами</h2>";

?>