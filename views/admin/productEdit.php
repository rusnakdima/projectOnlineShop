<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\widgets\LinkPager;

    $this->title = 'Product Edit';
?>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="row row-cols-auto">
        <h3 class="col-6 mb-3 fw-normal">Product Item</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($find, 'product', [
                'template' => '<div class="form-floating col d-flex text-right">{input}{label}<button class="border-0 bg-white text-dark"><ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon></button></div>',
                'inputOptions' => [
                    'id' => 'fProduct',
                    'class' => 'form-control me-2 bg-white text-dark'
                ],
                'labelOptions' => [
                    'for' => 'fProduct',
                ],
            ])->textInput()->label('Search product') ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h5>Products</h5>
    <table cellspacing="0" cellpadding="5" id="products">
        <thead>
            <tr>
                <td class="border">ID</td>
                <td class="border">Product (name)</td>
                <td class="border">Category (Name)</td>
                <td class="border">Subcategory (Name)</td>
                <td class="border">Prace ($)</td>
                <td class="border">Discount (%)</td>
                <td class="border">Description</td>
                <td class="border">Specifications</td>
                <td class="border">Link</td>
                <td class="border">Count add cart</td>
                <td class="border">Date create</td>
                <td class="border">Date update</td>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($dataProduct); $i++) { ?>
                <tr id="<?php echo $i; ?>">
                    <td class="border"><?php echo $dataProduct[$i]->id; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->product; ?></td>
                    <td class="border"><?php $num = $dataProduct[$i]->category; echo $category[$num-1]['category']; ?></td>
                    <td class="border"><?php $num = $dataProduct[$i]->subcategory; echo $subcategory[$num-1]['subcategory']; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->price; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->discount; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->description; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->specifications; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->link; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->count_add_cart; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->created_at; ?></td>
                    <td class="border"><?php echo $dataProduct[$i]->updated_at; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <?= LinkPager::widget([
        'pagination' => $pagesProduct,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link bg-white'],
    ]); ?>
</div>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <details>
        <summary class="h3 mb-3 fw-normal">Edit and Save Data</summary>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($productEdit, 'id', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'idP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'idP',
                ],
            ])->textInput()->label('ID') ?>
            <?= $form->field($productEdit, 'product', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'productP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'productP',
                ],
            ])->textInput()->label('Product') ?>
            <?= $form->field($productEdit, 'category', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'categoryP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'categoryP',
                ],
            ])->textInput(['type' => 'number'])->label('Category (ID)') ?>
            <div class="mx-2" id="categoryList">
                <span>List</span><br>
                <?php for($i = 0; $i < count($category); $i++){ ?>
                    <?php print_r('<span>'.($i+1).'—'.$category[$i]['category']."</span><br>"); ?>
                <?php } ?>
            </div>
            <?= $form->field($productEdit, 'subcategory', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'subcategoryP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'subcategoryP',
                ],
            ])->textInput(['type' => 'number'])->label('Subcategory (ID)') ?>
            <div class="mx-2" id="subcategoryList">
                <span>List</span><br>
                <?php for($i = 0; $i < count($subcategory); $i++){ ?>
                    <?php print_r('<span>'.($i+1).'—'.$subcategory[$i]['subcategory']."</span><br>"); ?>
                <?php } ?>
            </div>
            <?= $form->field($productEdit, 'price', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'priceP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'priceP',
                ],
            ])->textInput()->label('Price') ?>
            <?= $form->field($productEdit, 'discount', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'discountP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'discountP',
                ],
            ])->textInput()->label('Discount') ?>
            <?= $form->field($productEdit, 'description', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'descriptionP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'descriptionP',
                ],
            ])->textArea(['style' => 'height: 200px'])->label('Description') ?>
            <?= $form->field($productEdit, 'specifications', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'specificationsP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'specificationsP',
                ],
            ])->textArea(['style' => 'height: 200px'])->label('Specifications') ?>
            <?= $form->field($productEdit, 'link', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'linkP',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'linkP',
                ],
            ])->textInput()->label('Link') ?>
            <?= Html::submitButton('Update/Save', ['class' => 'btn btn-lg btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </details>
    <details>
        <summary class="h3 mb-3 fw-normal">Delete Data</summary>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($delItem, 'id', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'id1',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'id1',
                ],
            ])->textInput()->label('ID') ?>
            <?= Html::submitButton('Delete', ['class' => 'btn btn-lg btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </details>
</div>

<script>
    $(".pagination > li").attr('class', 'page-item');
    $("#categoryP, #subcategoryP").attr('autocomplete', 'off');
    $("#categoryList, #subcategoryList").hide();
    $("#categoryP").focus(function(){
        $("#categoryList").show();
    });
    $("#categoryP").blur(function(){
        $("#categoryList").hide();
    });
    $("#subcategoryP").focus(function(){
        $("#subcategoryList").show();
    });
    $("#subcategoryP").blur(function(){
        $("#subcategoryList").hide();
    });
    $("td").click(function(){
        var elem = $(this).parent();
        $(elem).css({'background': "#5f0"});
        setTimeout(function(){
            $(elem).css({'background': ""});
        }, 250);
        if($(this).parent().parent().parent().attr('id') == "products" && $(this).parent().parent().prop('nodeName') != "THEAD"){
            var tdAll = $($(this).parent()).children();
            $("#idP").val($(tdAll[0]).text());
            $("#productP").val($(tdAll[1]).text());
            <?php for($i = 0; $i < count($category); $i++){ ?>
                if('<?php echo $category[$i]['category']; ?>' == $(tdAll[2]).text()){
                    $("#categoryP").val(<?php echo $category[$i]['id']; ?>);
                }
            <?php } ?>
            <?php for($i = 0; $i < count($subcategory); $i++){ ?>
                if('<?php echo $subcategory[$i]['subcategory']; ?>' == $(tdAll[3]).text()){
                    $("#subcategoryP").val(<?php echo $subcategory[$i]['id']; ?>);
                }
            <?php } ?>
            $("#priceP").val($(tdAll[4]).text());
            $("#discountP").val($(tdAll[5]).text());
            $("#descriptionP").val($(tdAll[6]).text());
            $("#specificationsP").val($(tdAll[7]).text());
            $("#linkP").val($(tdAll[8]).text());
        }
    });
</script>