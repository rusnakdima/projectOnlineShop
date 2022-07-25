<?php
    $this->title = Yii::t('app', 'Cart');
    use yii\helpers\Url;
?>

<style>
    #cartPage ion-icon{
        width: 3em;
    }
</style>

<div class="bg-white text-dark my-3" id="cartPage">
    <!--Button clear basket-->
    <form method="post" action="<?= Url::to(['']); ?>">
        <input type="hidden" name="status" value="clear">
        <button type="submit" class="bg-white text-dark"><ion-icon name="trash-outline"></ion-icon></button>
    </form>
    <!--Output data from basket-->
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-2">
        <div class="col-12 col-xl-8">
            <h4 class="border-bottom"><?= Yii::t('app', 'My Basket') ?></h4>
            <?php if(!empty($data)){ ?>
                <?php $rez = 0.0; ?>
                <?php foreach($data['products'] as $item){ ?>
                    <div class="container row row-cols-auto mb-3 pb-3 border-bottom border-1">
                        <!--<div class="form-check">
                            <input class="form-check-input" type="radio" />
                        </div>-->
                        <img class="col" src="/assets/images/<?php echo $dataProduct[$item['id']-1]['link']; ?>" style="width: 200px; height: 200px;" />
                        <span class="col"><?php echo $item['name']; ?></span>
                        <input type="hidden" name="idR" value="<?php echo $item['id']; ?>" />
                        <input type="number" name="countR" class="col form-control w-25" style="height: 45px;" value="<?php echo $item['count']; ?>" />
                        <?php if($dataProduct[$item['id']-1]['discount'] > 0){ ?>
                            <div class="col">
                                <span class="row"><s name="priceR"><?php echo $item['price']; ?>$</s></span>
                                <span name="disPriceR" class="row container" style="color:red;"><?php echo $item['disPrice']; ?>$</span>
                            </div>
                        <?php } else { ?>
                            <div class="col">
                                <span name="priceR" class="col"><?php echo $item['price']; ?>$</span>
                                <span name="disPriceR" class="row container d-none" style="color:red;"><?php echo $item['disPrice']; ?>$</span>
                            </div>
                        <?php } ?>
                        <form class="col" method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                            <button type="submit" class="border-0 bg-white text-dark"><ion-icon name="close-circle-outline"></ion-icon></button>
                        </form>
                    </div>
                <?php } $i++; ?>
            <?php } else { ?>
                <span><?= Yii::t('app', 'The basket is empty.') ?></span>
            <?php } ?>
        </div>
        <div class="col-12 col-xl-4">
            <h4 class="border-bottom"><?= Yii::t('app', 'Order details') ?></h4>
            <h4><?= Yii::t('app', 'Total') ?> <span id="total"><?php echo $data['total']; ?></span>$</h4>
            <a href="<?= Url::to(['orders/orderedit']); ?>" class="btn btn-primary"><?= Yii::t('app', 'Place an order') ?></a>
        </div>
    </div>
</div>

<script>
    function ReCalc(){
        var countAll = $("[name=countR]");
        var disPriceAll = $("[name=disPriceR]");
        var total = 0.0;
        for(var i = 0; i < countAll.length; i++){
            total += $(disPriceAll[i]).text().slice(0, -1) * $(countAll[i]).val();
        }
        $("#total").text(total);
    }

    $("input[type=number]").click(function(){
        var idR = $("input[name=idR").val();
        var countR = $("input[name=countR").val();
        $.ajax({
            method: "POST",
            data: {
                idR: idR,
                countR: countR,
                statusR: 1
            },
            success: function(){
                ReCalc();
            }
        });
    });
    $("input[type=number]").blur(function(){
        var idR = $("input[name=idR").val();
        var countR = $("input[name=countR").val();
        $.ajax({
            method: "POST",
            data: {
                idR: idR,
                countR: countR,
                statusR: 1
            },
            success: function(){
                ReCalc();
            }
        });
    });
    /*$("input[type=radio]").click(function(){
        var radioBut = $('input[type=radio]');
        var amount = 0.0, total = 0.0;
        for(var i = 0; i < radioBut.length; i++){
            if($(radioBut[i]).is(':checked')){
                var count = $(radioBut[i]).parent().siblings('[name=countR]').val();
                var price = $(radioBut[i]).parent().children('.col').siblings("[name=priceR]").text().slice(0, -1);
                var disPrice = $(radioBut[i]).parent().children('.col').siblings("[name=disPriceR]").text().slice(0, -1);
                console.log(count, price, disPrice);
                amount += price * count;
                total += disPrice * count;
            }
        }
        $("#amount").text(amount);
        $("#total").text(total);
    });*/
    //if($("input[type=radio]").is(":checked")) $("input[type=radio]").prop('checked', false);
</script>