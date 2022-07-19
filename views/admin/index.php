<?php

    use yii\helpers\Url;

    $this->title = 'Admin Panel';
?>

<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content border bg-white text-dark">
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

<div class="bg-white text-dark px-5 py-5">
    <h3 class="mb-3 fw-normal text-center">Admin Panel</h3>
    <a class="btn btn-primary" id="catView" href="<?= Url::to(['catedit']); ?>">Category View Page</a>
    <a class="btn btn-primary" id="subcatView" href="<?= Url::to(['subcatedit']); ?>">Subcategory View Page</a>
    <a class="btn btn-primary" id="productView" href="<?= Url::to(['productedit']); ?>">Product View Page</a>
    <a class="btn btn-primary" id="OrderView" href="<?= Url::to(['orderitem']); ?>">Order View Page</a>
</div>

<script>
    $('.modal').show();
    if(<?= Yii::$app->session['admin'] ?>){
        $(".modal").hide();
    } else {
        $('.modal').show();
    }
</script>