<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $this->title = 'Order';
?>

<div class="modal border">
    <div class="modal-dialog">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Order rezult</h5>
            </div>
            <div class="modal-body">
                <p>The order has been successfully completed!</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" href="<?= Url::to(['products/cartitem']); ?>">Ok</a>
            </div>
        </div>
    </div>
</div>


<div class="container my-3 bg-white text-dark">
    <h3>Making an order</h3>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row row-cols-2">
            <div class="col-7">
                <h5>Contact information</h5>
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
                    ])->textInput()->label('Name') ?>
                    <?= $form->field($order, 'surname', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'surname',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'surname',
                        ],
                    ])->textInput()->label('Surname') ?>
                    <?= $form->field($order, 'phone', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'phone',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'phone',
                        ],
                    ])->textInput()->label('Phone') ?>
                    <?= $form->field($order, 'email', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'email',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'email',
                        ],
                    ])->textInput()->label('Email') ?>
                    <?= $form->field($order, 'address', [
                        'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                        'inputOptions' => [
                            'id' => 'address',
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'for' => 'address',
                        ],
                    ])->textInput()->label('Address') ?>
            </div>
            <div class="col-5">
                <div class="text-center"><h5>Your order</h5></div>
                <div class="row row-cols-2">
                    <div class="col-7">
                        <span>Products</span><br>
                        <span>Delivery</span><br>
                        <span>Discount</span><br>
                        <h4>Total</h4>
                    </div>
                    <div class="col-5">
                        <div class="text-end"><span><?= $dataCart['amount'] ?>$</span></div>
                        <div class="text-end"><span>0$</span></div>
                        <div class="text-end"><span><?= ($dataCart['total']/$dataCart['amount']); ?>%</span></div>
                        <div class="text-end"><h4><?= $dataCart['total'] ?>$</h4></div>
                    </div>
                </div>
                <?= Html::submitButton('Order', ['class' => 'btn btn-lg btn-primary', 'id' => 'order-btn']) ?>
            </div>
        </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<script>
    if(<?= $modalShow ?>){
        $(".modal").show();
    }
</script>