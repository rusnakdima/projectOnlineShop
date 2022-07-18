<?php

    namespace app\classes;

    use app\models\EditProduct;
    use Yii;

    class CartItem {
        public static function addItem($id, $count) {
            $count = (int)$count;
            if($count < 1) return;
            $id = abs((int)$id);
            
            $product = EditProduct::findOne($id);
            if(empty($product)) return;
            $session = Yii::$app->session;
            $session->open();
            if(!$session->has('basket')){
                $session->set('basket', []);
                $basket = [];
            } else {
                $basket = $session->get('basket');
            }
            
            if(isset($basket['products'][$product->id])){
                $basket['products'][$product->id]['count'] = $count;
            } else {
                $basket['products'][$product->id]['id'] = $product->id;
                $basket['products'][$product->id]['name'] = $product->product;
                $basket['products'][$product->id]['price'] = $product->price;
                $basket['products'][$product->id]['count'] = $count;
                $basket['products'][$product->id]['disPrice'] = $product->price-($product->price*($product->discount/100));
            }
            $product->count_add_cart += $count;
            $product->save();
            $amount = 0.0;
            $total = 0.0;
            foreach ($basket['products'] as $item) {
                $amount += $item['price'] * $item['count'];
                $total += $item['disPrice'] * $item['count'];
            }
            $basket['amount'] = $amount;
            $basket['total'] = $total;
            $session->set('basket', $basket);
            return 1;
        }

        public static function removeItem($id) {
            $id = abs((int)$id);
            $session = Yii::$app->session;
            $session->open();
            if (!$session->has('basket')) {
                return;
            }
            $basket = $session->get('basket');
            if (!isset($basket['products'][$id])) {
                return;
            }
            unset($basket['products'][$id]);
            if (count($basket['products']) == 0) {
                $session->set('basket', []);
                return 1;
            }
            $amount = 0.0;
            foreach ($basket['products'] as $item) {
                $amount += $item['price'] * $item['count'];
            }
            $basket['amount'] = $amount;
            $session->set('basket', $basket);
            return 1;
        }

        public static function getCart() {
            $session = Yii::$app->session;
            $session->open();
            if (!$session->has('basket')) {
                $session->set('basket', []);
                return [];
            } else {
                return $session->get('basket');
            }
        }

        public static function clearBasket(){
            $session = Yii::$app->session;
            $session->open();
            $session->set('basket', []);
        }
    }