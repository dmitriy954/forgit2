<?php

use yii\helpers\Html;

$query = yii\helpers\Html::encode($query);



app\modules\search\SearchAssets::register($this);
$this->registerJs("jQuery('.search').highlight('{$query}');");
?>

<div class="row">
    <div class="col-md-6 col-md-offset-2">
        
        <?php
        if (!empty($hits)):
            foreach ($hits as $hit):
                ?>
                <h3><a href="<?= yii\helpers\Url::to($hit->url, true) ?>"><?= $hit->title ?></a></h3>
                <p class="search"><?= $hit->body ?></p>
                <hr />
            <?php
            endforeach;
        else:
            ?>
            <div class="alert alert-danger"><h3>По запросу "<?= $query ?>" ничего не найдено!</h3></div>
        <?php
        endif;

        echo yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
        
        
    </div>
    <div class="col-md-3">
        
        <?= $this->render('_search_form', ['text' => "{$query}"]) ?>
        
        
    </div>
</div>