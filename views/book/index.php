<?php
$this->title = 'Работа с книгами';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url;
use yii\bootstrap5\Tabs

?>
<div class="row mb-2">
    <div class="col-12">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Left</button>
            <a href="#" class="btn btn-outline-primary">Middle</a>
            <a href="#" class="btn btn-outline-primary">Right</a>
        </div>
    </div>
</div>
<?php

echo Tabs::widget([
    'items' => [
        [
            'label' => '<i class="bi bi-eye-slash-fill"></i> Неопубликованные',
            'content' => $this->render('nonpublished'),
            'active' => true,
        ],
        [
            'label' => '<i class="bi bi-eye-fill"></i> Опубликованные',
            'content' => $this->render('published'),
        ],
        [
            'label' => '<i class="<i class="bi bi-bookshelf"></i> Серии книг',
            'content' => $this->render('series'),
        ],
    ],
//    'position' => Tabs::POS_ABOVE,
    'encodeLabels' => false
]);

?>
