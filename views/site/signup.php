<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';

?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 ">
                    <h3 class="mb-5 text-center"><?= Html::encode($this->title) ?></h3>
                    <?php
                    $form = ActiveForm::begin([
                            'id' => 'signup-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'form-label'],
                                'inputOptions' => ['class' => 'form-control form-control-lg'],
                                'errorOptions' => ['class' => 'invalid-feedback'],
                            ],
                    ]);

                    ?>
                    <div class="form-outline mb-4">
                        <?= $form->field($model, 'nickname') ?>
                    </div>
                    <div class="form-outline mb-4">
                        <?= $form->field($model, 'username') ?>
                    </div>
                    <div class="form-outline mb-4">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="text-end">
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

