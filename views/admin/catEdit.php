<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\widgets\LinkPager;

    $this->title = 'Category Edit';
?>

<div class="modal border">
    <div class="modal-dialog">
        <div class="modal-content bg-white text-dark">
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

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <a onclick="window.history.back();" class="text-decoration-none bg-white text-dark"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <div class="row row-cols-auto">
        <h3 class="col-6 mb-3 fw-normal">Category Item</h3>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($find, 'category', [
                'template' => '<div class="form-floating col d-flex text-right">{input}{label}<button class="border-0 bg-white text-dark"><ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon></button></div>',
                'inputOptions' => [
                    'id' => 'fCategory',
                    'class' => 'form-control me-2 bg-white text-dark'
                ],
                'labelOptions' => [
                    'for' => 'fCategory',
                ],
            ])->textInput()->label('Search Category') ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h5>Category</h5>
    <table cellspacing="0" cellpadding="5" id="categories">
        <thead>
            <tr>
                <td class="border">ID</td>
                <td class="border">Category (Name)</td>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($dataCategory); $i++) { ?>
                <tr>
                    <td class="border"><?php echo $dataCategory[$i]->id; ?></td>
                    <td class="border"><?php echo $dataCategory[$i]->category; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <?= LinkPager::widget([
        'pagination' => $pagesCategory,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link bg-white'],
    ]); ?>
</div>

<div class="container bg-white text-dark border rounded-2 px-5 py-5">
    <details>
        <summary class="h3 mb-3 fw-normal">Edit and Save Data</summary>
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($categoryEdit, 'id', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'idC',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'idC',
                ],
            ])->textInput()->label('ID') ?>
            <?= $form->field($categoryEdit, 'category', [
                'template' => '<div class="form-floating my-3">{input}{label}{error}</div>',
                'inputOptions' => [
                    'id' => 'categoryC',
                    'class' => 'form-control'
                ],
                'labelOptions' => [
                    'for' => 'categoryC',
                ],
            ])->textInput()->label('Category') ?>
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
    $('.modal').show();
    if(<?= Yii::$app->session['admin'] ?>){
        $(".modal").hide();
    } else {
        $('.modal').show();
    }
    $(".pagination > li").attr('class', 'page-item');
    $("td").click(function(){
        var elem = $(this).parent();
        $(elem).css({'background': "#5f0"});
        setTimeout(function(){
            $(elem).css({'background': ""});
        }, 250);
        if($(this).parent().parent().parent().attr('id') == "categories" && $(this).parent().parent().prop('nodeName') != "THEAD"){
            var tdAll = $($(this).parent()).children();
            $("#idC").val($(tdAll[0]).text());
            $("#categoryC").val($(tdAll[1]).text());
        }
    });
</script>