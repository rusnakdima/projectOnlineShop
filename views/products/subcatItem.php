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

<div class="row">
    <div class="col-auto">
        <form method="post" action="<?= Url::to(['', 'item' => $_GET['item'], 'sort' => $_GET['sort']]) ?>">
            <div class="p-3 bg-white text-dark" style="width: 15rem;">
                <button type="submit" class="btn border bg-white text-dark"><?= Yii::t('app', 'Apply') ?></button>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <?php $i = 0; foreach($filter as $key => $value) { ?>
                            <ul class="align-items-center border rounded-1 bg-white text-dark" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="true"><?= Yii::t('app', $key) ?></ul>
                            <div class="collapse" id="collapse<?= $i; ?>">
                                <?php foreach($value as $item){ ?>
                                    <?= '<label><input type="checkbox" value="'.$item.'" name="'.$key.'[]" class="me-2">'.$item.'</label>'; ?>
                                <?php } ?>
                            </div>
                        <?php $i++; } ?>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <div class="col">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 py-2 mt-5 mx-2 bg-white text-dark">
            <?php if($data != null){ ?>
                <?php foreach ($data as $item) { ?>
                    <div class="col mb-3">
                        <a href="<?= Url::to(['products/infoitem', 'item' => $item['product']]); ?>" class="link-dark text-decoration-none">
                            <img style="width: 200px; height: 200px;" alt="Image" src="/assets/images/<?php echo $item['link']; ?>" /><br>
                            <h5><?php echo $item['product']; ?></h5>
                            <?php if ($item['discount'] > 0) { ?>
                                <h5><b><i><?php $num = $item['price'] - ($item['price'] * ($item['discount'] / 100)); echo $num; ?>$</i></b></h5>
                                <h5 class="text-muted"><i><s><?php echo $item['price']; ?>$</s></i></h5>
                            <?php } else { ?>
                                <h5><b><i><?php echo $item['price']; ?>$</i></b></h5>
                            <?php } ?>
                            <span><?php echo $item['orders']; ?> <?= Yii::t('app', 'orders') ?></span>
                        </a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info"><?= Yii::t('app', 'No products with such filter parameters were found!') ?></div>
            <?php } ?>
        </div>
    </div>
</div>