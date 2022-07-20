<?php

    use yii\helpers\Url;

    $this->title = Yii::t('app', 'Admin Panel');
?>

<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content border bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title"><?= Yii::t('app', 'Password Request') ?></h5>
            </div>
            <form method="post" action="<?= Url::to(['']); ?>">
                <div class="modal-body">
                    <?php if($rezIn){ ?>
                        <span style="color:red;"><?= Yii::t('app', 'Incorrect Password') ?></span>
                    <?php } ?>
                    <input type="text" class="form-control" placeholder="<?= Yii::t('app', 'Enter your password') ?>" name="pass" autocomplete="off" required />
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="<?= Url::to(['site/index']); ?>"><?= Yii::t('app', 'Cancel') ?></a>
                    <button class="btn btn-primary"><?= Yii::t('app', 'Ok') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-white text-dark px-5 py-5">
    <h3 class="mb-3 fw-normal text-center"><?= Yii::t('app', 'Admin Panel') ?></h3>
    <a class="btn btn-primary" id="catView" href="<?= Url::to(['catedit']); ?>"><?= Yii::t('app', 'Category View Page') ?></a>
    <a class="btn btn-primary" id="subcatView" href="<?= Url::to(['subcatedit']); ?>"><?= Yii::t('app', 'Subcategory View Page') ?></a>
    <a class="btn btn-primary" id="productView" href="<?= Url::to(['productedit']); ?>"><?= Yii::t('app', 'Product View Page') ?></a>
    <a class="btn btn-primary" id="OrderView" href="<?= Url::to(['orderitem']); ?>"><?= Yii::t('app', 'Order View Page') ?></a>
</div>

<script>
    $('.modal').show();
    if(<?= Yii::$app->session['admin'] ?>){
        $(".modal").hide();
    } else {
        $('.modal').show();
    }
</script>