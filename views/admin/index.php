<?php
    use yii\helpers\Url;

    $this->title = 'Admin Panel';
?>

<div class="bg-white text-dark px-5 py-5">
    <h3 class="mb-3 fw-normal text-center">Admin Panel</h3>
    <a class="btn btn-primary" id="catView" href="<?= Url::to(['catedit']); ?>">Category View Page</a>
    <a class="btn btn-primary" id="subcatView" href="<?= Url::to(['subcatedit']); ?>">Subcategory View Page</a>
    <a class="btn btn-primary" id="productView" href="<?= Url::to(['productedit']); ?>">Product View Page</a>
    <a class="btn btn-primary" id="OrderView" href="<?= Url::to(['orderitem']); ?>">Order View Page</a>
</div>