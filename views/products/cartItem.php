<?php
    $this->title = 'Cart';
    use yii\helpers\Url;
?>

<style>
    #cartPage ion-icon{
        width: 3em;
    }
</style>

<div class="bg-white text-dark my-3" id="cartPage">
    <!--Button clear basket-->
    <form method="post" action="/cartitem">
        <input type="hidden" name="status" value="clear">
        <button type="submit" class="bg-white text-dark"><ion-icon name="trash-outline"></ion-icon></button>
    </form>
    <!--Output data from basket-->
    <div class="row row-cols-2">
        <div class="col-md-8">
            <h4 class="border-bottom">My Basket</h4>
            <?php if(!empty($data)){ ?>
                <?php $rez = 0.0; ?>
                <?php foreach($data['products'] as $item){ ?>
                    <div class="container row row-cols-auto mb-3 pb-3 border-bottom border-1">
                        <img class="col" src="assets/images/<?php echo $dataProduct[$item['id']-1]['link']; ?>" />
                        <span class="col"><?php echo $item['name']; ?></span>
                        <input type="hidden" name="idR" value="<?php echo $item['id']; ?>" />
                        <input type="number" name="countR" class="col form-control w-25" value="<?php echo $item['count']; ?>" />
                        <?php if($dataProduct[$item['id']-1]['discount'] > 0){ ?>
                            <div class="col">
                                <span class="row"><s name="priceR"><?php echo $item['price']; ?>$</s></span>
                                <span name="disPriceR" class="row container" style="color:red;"><?php echo $item['disPrice']; ?>$</span>
                            </div>
                        <?php } else { ?>
                            <span name="priceR" class="col"><?php echo $item['price']; ?>$</span>
                        <?php } ?>
                        <form class="col" method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                            <button type="submit" class="border-0 bg-white text-dark"><ion-icon name="close-circle-outline"></ion-icon></button>
                        </form>
                    </div>
                <?php } $i++; ?>
            <?php } else { ?>
                <span>The basket is empty.</span>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <h4 class="border-bottom">Details Order</h4>
            <h4>Cost <span id="amount"><?php echo $data['amount']; ?></span>$</h4>
            <h4>Total <span id="total"><?php echo $data['total']; ?></span>$</h4>
            <a href="<?= Url::to(['orders/orderedit']); ?>" class="btn btn-primary">Price an order</a>
        </div>
    </div>
</div>

<script>
    function ReCalc(){
        var countAll = $("[name=countR]");
        var priceAll = $("[name=priceR]");
        var disPriceAll = $("[name=disPriceR]");
        var amount = 0.0, total = 0.0;
        for(var i = 0; i < countAll.length; i++){
            amount += $(priceAll[i]).text().slice(0, -1) * $(countAll[i]).val();
            total += $(disPriceAll[i]).text().slice(0, -1) * $(countAll[i]).val();
        }
        $("#amount").text(amount);
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
</script>