<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Случайная книга';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Вывести случайную книгу.
    </p>
</div>