<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $this->title = Yii::t('app', 'Making an order');
?>

<div class="modal border">
    <div class="modal-dialog">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title"><?= Yii::t('app', 'The result of the order') ?></h5>
            </div>
            <div class="modal-body">
                <p><?= Yii::t('app', 'The order has been successfully completed!') ?></p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" href="<?= Url::to(['products/cartitem']); ?>">Ok</a>
            </div>
        </div>
    </div>
</div>


<div class="container my-3 bg-white text-dark">
    <h3><?= Yii::t('app', 'Making an order') ?></h3>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row row-cols-2">
            <div class="col-7">
                <h5><?= Yii::t('app', 'Contact information') ?></h5>
                    <?php $str; foreach($dataCart['products'] as $item){
                        $str .= $item['id'].', ';
                    } ?>
                    <?= $form->field($order, 'product_id', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'product_id',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'product_id',
                        ],
                    ])->hiddenInput(['value' => $str]) ?>
                    <?= $form->field($order, 'user_id', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'user_id',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'user_id',
                        ],
                    ])->hiddenInput(['value' => $account]) ?>
                    <?php $str1; foreach($dataCart['products'] as $item){
                        $str1 .= $item['count'].', ';
                    } ?>
                    <?= $form->field($order, 'count', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'count',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'count',
                        ],
                    ])->hiddenInput(['value' => $str1]) ?>
                    <?php $str2; foreach($dataCart['products'] as $item){
                        $str2 .= $item['disPrice']*$item['count'].', ';
                    } ?>
                    <?= $form->field($order, 'cost', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'cost',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'cost',
                        ],
                    ])->hiddenInput(['value' => $str2]) ?>
                    <?= $form->field($order, 'name', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'name',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'name',
                        ],
                    ])->textInput()->label(Yii::t('app', 'Name')) ?>
                    <?= $form->field($order, 'surname', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'surname',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'surname',
                        ],
                    ])->textInput()->label(Yii::t('app', 'Surname')) ?>
                    <?= $form->field($order, 'phone', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'phone',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'phone',
                        ],
                    ])->textInput()->label(Yii::t('app', 'Phone')) ?>
                    <?= $form->field($order, 'email', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'email',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'email',
                        ],
                    ])->textInput()->label(Yii::t('app', 'Email')) ?>
                    <?= $form->field($order, 'address', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'address',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'address',
                        ],
                    ])->textInput()->label(Yii::t('app', 'Address')) ?>
            </div>
            <div class="col-5">
                <div class="text-center"><h5><?= Yii::t('app', 'Order details') ?></h5></div>
                <div class="row row-cols-2">
                    <div class="col-7">
                        <span><?= Yii::t('app', 'Products') ?></span><br>
                        <span><?= Yii::t('app', 'Delivery') ?></span><br>
                        <span><?= Yii::t('app', 'Discount') ?></span><br>
                        <h4><?= Yii::t('app', 'Total') ?></h4>
                    </div>
                    <div class="col-5">
                        <div class="text-end"><span><?= $dataCart['amount'] ?>$</span></div>
                        <div class="text-end"><span>0$</span></div>
                        <div class="text-end"><span><?= ($dataCart['total']/$dataCart['amount']); ?>%</span></div>
                        <div class="text-end"><h4><?= $dataCart['total'] ?>$</h4></div>
                    </div>
                </div>
                <?= Html::submitButton(Yii::t('app', 'To order'), ['class' => 'btn btn-lg btn-primary', 'id' => 'order-btn']) ?>
            </div>
        </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<script>
    if(<?= $modalShow ?>){
        $(".modal").show();
    }
</script>