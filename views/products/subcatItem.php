<?php
    use yii\helpers\Url;

    $this->title = Yii::t('app', $_GET['item']);
?>

<div class="container">
    <span><?= Yii::t('app', 'Show') ?>: <a class="nav-item dropdown-toggle bg-white text-dark" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
            if($_GET['sort'] == 'popularity') echo Yii::t('app', 'By popularity');
            else if($_GET['sort'] == 'asc') echo Yii::t('app', 'Low-to-High');
            else if($_GET['sort'] == 'desc') echo Yii::t('app', 'High-to-Low');
            else if($_GET['sort'] == 'orders') echo Yii::t('app', 'By orders');
            else if($_GET['sort'] == 'novelty') echo Yii::t('app', 'By novelty');
        ?>
    </a>
        <ul class="dropdown-menu bg-white text-dark border" aria-labelledby="navbarDropdown1">
            <li><a class="dropdown-item text-dark" href="<?= Url::to(['products/subcatitem', 'item' => $_GET['item'], 'sort'=>'asc']); ?>"><?= Yii::t('app', 'Low-to-High') ?></a></li>
            <li><a class="dropdown-item text-dark" href="<?= Url::to(['products/subcatitem', 'item' => $_GET['item'], 'sort'=>'desc']); ?>"><?= Yii::t('app', 'High-to-Low') ?></a></li>
            <li><a class="dropdown-item text-dark" href="<?= Url::to(['products/subcatitem', 'item' => $_GET['item'], 'sort'=>'orders']); ?>"><?= Yii::t('app', 'By orders') ?></a></li>
            <li><a class="dropdown-item text-dark" href="<?= Url::to(['products/subcatitem', 'item' => $_GET['item'], 'sort'=>'popularity']); ?>"><?= Yii::t('app', 'By popularity') ?></a></li>
            <li><a class="dropdown-item text-dark" href="<?= Url::to(['products/subcatitem', 'item' => $_GET['item'], 'sort'=>'novelty']); ?>"><?= Yii::t('app', 'By novelty') ?></a></li>
        </ul>
    </span>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 py-2 mt-5 mx-2 bg-white text-dark">
    <?php foreach($data as $item){ ?>
        <div class="col mb-3">
            <a href="<?= Url::to(['products/infoitem', 'item'=>$item['product']]); ?>" class="link-dark text-decoration-none">
                <img style="width: 200px; height: 200px;" alt="Image" src="/assets/images/<?php echo $item['link']; ?>" /><br>
                <!--<span><?php $num = $item['category']; echo $category[$num-1]['category']; ?> -> <?php $num = $item['subcategory']; echo $subcategory[$num-1]['subcategory']; ?></span>-->
                <h5><?php echo $item['product']; ?></h5>
                <?php if($item['discount'] > 0){ ?>
                    <h5><b><i><?php $num = $item['price'] - ($item['price'] * ($item['discount'] / 100)); echo $num; ?>$</i></b></h5>
                    <h5 class="text-muted"><i><s><?php echo $item['price']; ?>$</s></i></h5>
                <?php } else { ?>
                    <h5><b><i><?php echo $item['price']; ?>$</i></b></h5>
                <?php } ?>
                <span><?php echo $item['orders']; ?> <?= Yii::t('app', 'orders') ?></span>
            </a>
        </div>
    <?php } ?>
</div>