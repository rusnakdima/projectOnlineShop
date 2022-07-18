<?php
    $this->title = 'Home';
    use yii\helpers\Url;
?>

<h1 class="fw-light">Home</h1>

<section class="justify-content-center container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" onclick="popular();" id="popular">Popular</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="newProduct();" id="newProduct">New products</a>
        </li>
    </ul>
</section>

<div id="blockPopular" class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 bg-white text-dark">
        <?php foreach($dataPopular as $item){ ?>
            <div class="col mb-3">
                <a href="<?= Url::to(['products/infoitem', 'item'=>$item['product']]); ?>" class="link-dark text-decoration-none">
                    <img style="width: auto; height: auto;" alt="Image" src="assets/images/<?php echo $item['link']; ?>" /><br>
                    <!--<span><?php $num = $item['category']; echo $category[$num-1]['category']; ?> -> <?php $num = $item['subcategory']; echo $subcategory[$num-1]['subcategory']; ?></span>-->
                    <h5><?php echo $item['product']; ?></h5>
                    <?php if($item['discount'] > 0){ ?>
                        <h5><b><i><?php $num = $item['price'] - ($item['price'] * ($item['discount'] / 100)); echo $num; ?>$</i></b></h5>
                        <h5 class="text-muted"><i><s><?php echo $item['price']; ?>$</s></i></h5>
                    <?php } else { ?>
                        <h5><b><i><?php echo $item['price']; ?>$</i></b></h5>
                    <?php } ?>
                    <span><?php echo $item['orders']; ?> orders</span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<div id="blockNewProduct" class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 bg-white text-dark">
        <?php foreach($dataNewProduct as $item){ ?>
            <div class="col mb-3">
                <a href="<?= Url::to(['products/infoitem', 'item'=>$item['product']]); ?>" class="link-dark text-decoration-none">
                    <img style="width: auto; height: auto;" alt="Image" src="assets/images/<?php echo $item['link']; ?>" /><br>
                    <!--<span><?php $num = $item['category']; echo $category[$num-1]['category']; ?> -> <?php $num = $item['subcategory']; echo $subcategory[$num-1]['subcategory']; ?></span>-->
                    <h5><?php echo $item['product']; ?></h5>
                    <?php if($item['discount'] > 0){ ?>
                        <h5><b><i><?php $num = $item['price'] - ($item['price'] * ($item['discount'] / 100)); echo $num; ?>$</i></b></h5>
                        <h5 class="text-muted"><i><s><?php echo $item['price']; ?>$</s></i></h5>
                    <?php } else { ?>
                        <h5><b><i><?php echo $item['price']; ?>$</i></b></h5>
                    <?php } ?>
                    <span><?php echo $item['orders']; ?> orders</span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(()=>{
        $('#blockPopular').show();
        $('#blockNewProduct').hide();
    });
    function popular(){
        $("#popular").attr('class', 'nav-link active');
        $("#newProduct").attr('class', 'nav-link');
        $('#blockPopular').show();
        $('#blockNewProduct').hide();
    }
    function newProduct(){
        $("#popular").attr('class', 'nav-link');
        $("#newProduct").attr('class', 'nav-link active');
        $('#blockPopular').hide();
        $('#blockNewProduct').show();
    }
</script>