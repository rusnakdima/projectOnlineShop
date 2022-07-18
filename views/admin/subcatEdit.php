<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\LinkPager;

    $this->title = 'Subcategory Edit';
?>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="row row-cols-auto">
        <h3 class="col-6 mb-3 fw-normal">Subcategory Item</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($find, 'subcategory', [
                'template' => '<div class="form-floating col d-flex text-right">{input}{label}<button class="border-0 bg-white text-dark"><ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon></button></div>',
                'inputOptions' => [
                    'id' => 'fSubcat',
                    'class' => 'form-control me-2 bg-white text-dark'
                ],
                'labelOptions' => [
                    'for' => 'fSubcat',
                ],
            ])->textInput()->label('Search Subcategory') ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h5>Subcategory</h5>
    <table cellspacing="0" cellpadding="5" id="subcategories">
        <thead>
            <tr>
                <td class="border">ID</td>
                <td class="border">Subcategory (Name)</td>
                <td class="border">Category (Name)</td>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($dataSubcategory); $i++) { ?>
                <tr>
                    <td class="border"><?php echo $dataSubcategory[$i]->id; ?></td>
                    <td class="border"><?php echo $dataSubcategory[$i]->subcategory; ?></td>
                    <td class="border"><?php $num = $dataSubcategory[$i]->category; echo $category[$num-1]['category']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <?= LinkPager::widget([
        'pagination' => $pagesSubcategory,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link bg-white'],
    ]); ?>
</div>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <details>
        <summary class="h3 mb-3 fw-normal">Edit and Save Data</summary>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($subcategoryEdit, 'id', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'idS',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'idS',
                ],
            ])->textInput()->label('ID') ?>
            <?= $form->field($subcategoryEdit, 'subcategory', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'subcategoryS',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'subcategoryS',
                ],
            ])->textInput()->label('Subcategory') ?>
            <?= $form->field($subcategoryEdit, 'category', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'categoryS',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'categoryS',
                ],
            ])->textInput()->label('Category (ID)') ?>
            <div class="mx-2" id="categoryList">
                <span>List</span><br>
                <?php for($i = 0; $i < count($category); $i++){ ?>
                    <?php print_r('<span>'.($i+1).'—'.$category[$i]['category']."</span><br>"); ?>
                <?php } ?>
            </div>
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
    $("#categoryS").attr('autocomplete', 'off');
    $("#categoryList, #subcategoryList").hide();
    $("#categoryS").focus(function(){
        $("#categoryList").show();
    });
    $("#categoryS").blur(function(){
        $("#categoryList").hide();
    });
    $("td").click(function(){
        var elem = $(this).parent();
        $(elem).css({'background': "#5f0"});
        setTimeout(function(){
            $(elem).css({'background': ""});
        }, 250);
        if($(this).parent().parent().parent().attr('id') == "subcategories" && $(this).parent().parent().prop('nodeName') != "THEAD"){
            var tdAll = $($(this).parent()).children();
            $("#idS").val($(tdAll[0]).text());
            $("#subcategoryS").val($(tdAll[1]).text());
            <?php for($i = 0; $i < count($category); $i++){ ?>
                if('<?php echo $category[$i]['category']; ?>' == $(tdAll[2]).text()){
                    $("#categoryS").val(<?php echo $category[$i]['id']; ?>);
                }
            <?php } ?>
        }
    });
</script>