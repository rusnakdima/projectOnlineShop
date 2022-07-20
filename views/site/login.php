<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Login');

/* @var $this yii\web\View */
/* @var $model app\models\Login */
/* @var $form ActiveForm */
?>
<div class="text-center container bg-white border rounded-5 px-5 py-5">
    <h1 class="h3 mb-3 fw-normal"><?= Yii::t('app', 'Login') ?></h1>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username', [
            'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
            'inputOptions' => [
                'id' => 'username',
                'class' => 'form-control'
            ],
            'labelOptions' => [
                'for' => 'username',
            ],
        ])->textInput()->label(Yii::t('app', 'Username')) ?>
        <?= $form->field($model, 'password', [
            'template' => '<div class="form-floating my-3">{input}{label}{error}<input type="checkbox" id="pass_show" class="form-check-input me-3">'.Yii::t("app", "Show Password").'</div>',
            'inputOptions' => [
                'id' => 'passUser',
                'class' => 'form-control'
            ],
            'labelOptions' => [
                'for' => 'passUser',
            ],
        ])->passwordInput()->label(Yii::t('app', 'Password')) ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => '<div class="mb-3">{input}{label}{error}</div>',
            'class' => 'form-check-input me-3',
            'labelOptions' => [
                'class' => 'form-check-label',
            ]
        ]) ?>
        <?= Html::submitButton(Yii::t('app', 'Log in'), ['class' => 'w-100 btn btn-lg btn-primary']) ?>
    <?php ActiveForm::end(); ?>
    <p class="mt-5 mb-3 text-muted">© 2022</p>
</div>
<script>
    $('#pass_show').click(function(){
        if ($(this).is(':checked')){
            $("#passUser").attr('type', 'text');
        } else {
            $("#passUser").attr('type', 'password');
        }
    });
</script>