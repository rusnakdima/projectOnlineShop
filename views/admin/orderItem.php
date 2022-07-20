<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\widgets\LinkPager;

    $this->title = Yii::t('app', 'Order Item');
?>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="row row-cols-auto">
        <h3 class="col-6 mb-3 fw-normal"><?= Yii::t('app', 'Orders report') ?></h3>
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
            ])->textInput()->label(Yii::t('app', 'Search order')) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <br>
    <table cellspacing="0" cellpadding="5" id="orders">
        <thead>
            <tr>
                <td class="border">ID</td>
                <td class="border"><?= Yii::t('app', 'Product name') ?></td>
                <td class="border"><?= Yii::t('app', 'Username') ?></td>
                <td class="border"><?= Yii::t('app', 'Name') ?></td>
                <td class="border"><?= Yii::t('app', 'Surname') ?></td>
                <td class="border"><?= Yii::t('app', 'Date added') ?></td>
                <td class="border"><?= Yii::t('app', 'Address') ?></td>
                <td class="border"><?= Yii::t('app', 'Phone') ?></td>
                <td class="border"><?= Yii::t('app', 'Email') ?></td>
                <td class="border"><?= Yii::t('app', 'Number of') ?></td>
                <td class="border"><?= Yii::t('app', 'Cost') ?></td>
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