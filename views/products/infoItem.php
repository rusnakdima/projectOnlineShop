<?php
    $this->title = $_GET['item'];
    use yii\helpers\Url;
    use yii\helpers\Html;
?>


<div class="bg-white text-dark my-3">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="mx-auto mb-3" style="width: 75%; height: auto; text-align: center;">
        <img src="/assets/images/<?php echo $data['link']; ?>" class="mx-auto" style="width: 300px; height: 300px;" />
    </div>
    <div class="mx-auto row row-cols-2" style="width: 75%;">
        <div class="col-5">
            <h4><?php echo $data['product']; ?></h4>
            <p><?php echo $data['description']; ?></p>
            <p><?php echo $data['specifications']; ?></p>
        </div>
        <div class="col-5 ms-5">
            <?php if($data['discount'] > 0){ ?>
                <h5><s><?php echo $data['price']; ?>$</s></h5>
                <h5><span style="color: red;"><?php $num = $data['price'] - ($data['price'] * ($data['discount'] / 100)); echo $num; ?>$</span></h5>
            <?php } else { ?>
                <h5><?php echo $data['price']; ?>$</h5>
            <?php } ?>
            <span><?= Yii::t('app', 'Number of') ?></span>
            <form method="post" action="<?= Url::to(['products/infoitem', 'item' => $data['product']]); ?>">
                <input type="number" name="count" class="form-control" value="1" /><br>
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken); ?>
                <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add to cart') ?></button>
            </form>
        </div>
    </div>
</div>