<?php
use yii\helpers\Url;

$this->title = 'Страница администратора';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bx-title_div" style="text-align: center">
<h1 id="pagetitle" class="bx-title dbg_title" style="display: inline-block">Страница администратора </h1>
</div>

<div><a href="<?php echo Url::to(['ordersad/index']); ?>" target = "_blank"> <span style = "font-size: 30px;" >Работа с заказами </span>  </a></div>
<div><a href="<?php echo Url::to(['update/index']); ?>" target = "_blank"> <span style = "font-size: 30px;" >Работа с товарами </span>  </a></div>