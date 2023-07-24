<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Книги по жанрам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Тут список жанров, по клику на который вывести список книг этого жанра
    </p>
</div>