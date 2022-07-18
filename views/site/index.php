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

<div id="blockPopular">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 bg-white text-dark">
        <?php for($i = 0; $i < count($dataPopular); $i++){ ?>
            <div class="col mb-3">
                <a href="<?= Url::to(['products/infoitem', 'item'=>$dataPopular[$i]['product']]); ?>" class="link-dark text-decoration-none">
                    <div class="text-center">
                        <img style="width: auto; height: auto;" alt="Image" src="assets/images/<?php echo $dataPopular[$i]['link']; ?>" /><br>
                        <!--<span><?php $num = $dataPopular[$i]['category']; echo $category[$num-1]['category']; ?> -> <?php $num = $dataPopular[$i]['subcategory']; echo $subcategory[$num-1]['subcategory']; ?></span>-->
                        <h5><?php echo $dataPopular[$i]['product']; ?></h5>
                        <?php if($dataPopular[$i]['discount'] > 0){ ?>
                            <h5><s><?php echo $dataPopular[$i]['price']; ?>$</s></h5>
                            <h5><span style="color: red;"><?php $num = $dataPopular[$i]['price'] - ($dataPopular[$i]['price'] * ($dataPopular[$i]['discount'] / 100)); echo $num; ?>$</span></h5>
                        <?php } else { ?>
                            <h5><?php echo $dataPopular[$i]['price']; ?>$</h5>
                        <?php } ?>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<div id="blockNewProduct">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 bg-white text-dark">
        <?php for($i = 0; $i < count($dataNewProduct); $i++){ ?>
            <div class="col mb-3">
                <a href="<?= Url::to(['products/infoitem', 'item'=>$dataNewProduct[$i]['product']]); ?>" class="link-dark text-decoration-none">
                    <div class="text-center">
                        <img style="width: auto; height: auto;" alt="Image" src="assets/images/<?php echo $dataNewProduct[$i]['link']; ?>" /><br>
                        <!--<span><?php $num = $dataNewProduct[$i]['category']; echo $category[$num-1]['category']; ?> -> <?php $num = $dataNewProduct[$i]['subcategory']; echo $subcategory[$num-1]['subcategory']; ?></span>-->
                        <h5><?php echo $dataNewProduct[$i]['product']; ?></h5>
                        <?php if($dataNewProduct[$i]['discount'] > 0){ ?>
                            <h5><s><?php echo $dataNewProduct[$i]['price']; ?>$</s></h5>
                            <h5><span style="color: red;"><?php $num = $dataNewProduct[$i]['price'] - ($dataNewProduct[$i]['price'] * ($dataNewProduct[$i]['discount'] / 100)); echo $num; ?>$</span></h5>
                        <?php } else { ?>
                            <h5><?php echo $dataNewProduct[$i]['price']; ?>$</h5>
                        <?php } ?>
                    </div>
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