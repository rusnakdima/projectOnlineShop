<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\widgets\LinkPager;

    $this->title = 'Order Item';
?>

<div class="modal border">
    <div class="modal-dialog">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Password Request</h5>
            </div>
            <form method="post" action="<?= Url::to(['']); ?>">
                <div class="modal-body">
                    <?php if($rezIn){ ?>
                        <span style="color:red;">Incorrect Password</span>
                    <?php } ?>
                    <input type="text" class="form-control" placeholder="Enter your password" name="pass" autocomplete="off" required />
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="<?= Url::to(['site/index']); ?>">Cancel</a>
                    <button class="btn btn-primary">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="row row-cols-auto">
        <h3 class="col-6 mb-3 fw-normal">Order Item</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($find, 'product_id', [
                'template' => '<div class="form-floating col d-flex text-right">{input}{label}<button class="border-0 bg-white text-dark"><ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon></button></div>',
                'inputOptions' => [
                    'id' => 'fOrder',
                    'class' => 'form-control me-2 bg-white text-dark'
                ],
                'labelOptions' => [
                    'for' => 'fOrder',
                ],
            ])->textInput()->label('Search order') ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h5>Orders</h5>
    <table cellspacing="0" cellpadding="5" id="orders">
        <thead>
            <tr>
                <td class="border">ID</td>
                <td class="border">Product (name)</td>
                <td class="border">Username</td>
                <td class="border">Name</td>
                <td class="border">Surname</td>
                <td class="border">Date added</td>
                <td class="border">Address</td>
                <td class="border">Phone</td>
                <td class="border">Email</td>
                <td class="border">Count</td>
                <td class="border">Cost</td>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($dataOrder); $i++) { ?>
                <tr>
                    <td class="border"><?php echo $dataOrder[$i]->id; ?></td>
                    <td class="border"><?php $num = $dataOrder[$i]->product_id; echo $dataProduct[$num-1]['product']; ?></td>
                    <td class="border"><?php $num = $dataOrder[$i]->user_id; echo $account[$num-1]['username']; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->name; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->surname; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->date; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->address; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->phone; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->email; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->count; ?></td>
                    <td class="border"><?php echo $dataOrder[$i]->cost; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <?= LinkPager::widget([
        'pagination' => $pagesOrder,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link bg-white'],
    ]); ?>
</div>

<script>
    $('.modal').show();
    if(<?= Yii::$app->session['admin'] ?>){
        $(".modal").hide();
    } else {
        $('.modal').show();
    }
</script>