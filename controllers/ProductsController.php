<?php

    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\EditProduct;
    use app\classes\CartItem;

    class ProductsController extends Controller{
        public function actions(){
            return [
                'view' => [
                    'class' => 'yii\web\ViewAction',
                    'viewPrefix' => '',
                ],
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
                'captcha' => [
                    'class' => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                ],
            ];
        }
        public function actionSearch(){
            $dataOrder = (new \yii\db\Query())->from('orders')->all();
            $arr = [];
            foreach($dataOrder as $item){
                if(array_key_exists($item['product_id'], $arr)){
                    $arr[$item['product_id']] += $item['count'];
                } else {
                    $arr[$item['product_id']] = $item['count'];
                }
            }

            if ($_GET['sort'] == 'popularity'){
                $data = (new \yii\db\Query())->from('products')->where(['like', 'product', '%'.$_GET['searchData'].'%', false])->orderBy('count_add_cart DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] == 'orders'){
                $data = (new \yii\db\Query())->from('products')->where(['like', 'product', '%'.$_GET['searchData'].'%', false])->orderBy('count_add_cart DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
                foreach($data as $key => $val){
                    foreach($data as $key1 => $val){
                        if($data[$key]['orders'] < $data[$key+1]['orders']){
                            $temp = $data[$key];
                            $data[$key] = $data[$key+1];
                            $data[$key+1] = $temp;
                        }
                    }
                }
            } else if ($_GET['sort'] == 'novelty'){
                $data = (new \yii\db\Query())->from('products')->where(['like', 'product', '%'.$_GET['searchData'].'%', false])->orderBy('created_at DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] != null){
                $data = (new \yii\db\Query())->from('products')->where(['like', 'product', '%'.$_GET['searchData'].'%', false])->orderBy('price '.$_GET['sort'])->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            }

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            return $this->render('search', [
                'data' => $data,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionCatitem(){
            $dataOrder = (new \yii\db\Query())->from('orders')->all();
            $arr = [];
            foreach($dataOrder as $item){
                if(array_key_exists($item['product_id'], $arr)){
                    $arr[$item['product_id']] += $item['count'];
                } else {
                    $arr[$item['product_id']] = $item['count'];
                }
            }

            if ($_GET['sort'] == 'popularity'){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->select('id')->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('count_add_cart DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] == 'orders'){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->select('id')->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
                foreach($data as $key => $val){
                    foreach($data as $key1 => $val){
                        if($data[$key]['orders'] < $data[$key+1]['orders']){
                            $temp = $data[$key];
                            $data[$key] = $data[$key+1];
                            $data[$key+1] = $temp;
                        }
                    }
                }
            } else if ($_GET['sort'] == 'novelty'){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->select('id')->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('created_at DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] != null){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->select('id')->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('price '.$_GET['sort'])->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            }

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            return $this->render('catitem', [
                'data' => $data,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionSubcatitem(){
            $dataOrder = (new \yii\db\Query())->from('orders')->all();
            $arr = [];
            foreach($dataOrder as $item){
                if(array_key_exists($item['product_id'], $arr)){
                    $arr[$item['product_id']] += $item['count'];
                } else {
                    $arr[$item['product_id']] = $item['count'];
                }
            }
            
            if ($_GET['sort'] == 'popularity'){
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->select('id')->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('count_add_cart DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] == 'orders'){
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->select('id')->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
                foreach($data as $key => $val){
                    foreach($data as $key1 => $val){
                        if($data[$key]['orders'] < $data[$key+1]['orders']){
                            $temp = $data[$key];
                            $data[$key] = $data[$key+1];
                            $data[$key+1] = $temp;
                        }
                    }
                }
            } else if ($_GET['sort'] == 'novelty'){
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->select('id')->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('created_at DESC')->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            } else if($_GET['sort'] != null){
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->select('id')->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('price '.$_GET['sort'])->all();
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['orders'] = 0;
                }
                foreach($data as $key => $item){
                    foreach($arr as $key1 => $val){
                        if($item['id'] == $key1){
                            $data[$key]['orders'] = $val;
                        }
                    }
                }
            }

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            return $this->render('subcatitem', [
                'data' => $data,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionInfoitem(){
            $data = (new \yii\db\Query())->from('products')->where(['product'=> $_GET['item']])->one();

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            $basket = new CartItem();
            $dataPost = Yii::$app->request->post();

            if($basket->addItem($dataPost['id'], $dataPost['count'])){
                return $this->redirect(['products/infoitem', 'item' => $data['product']]);
            }

            return $this->render('infoitem', [
                'data' => $data,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionCartitem(){
            $data = CartItem::getCart();
            $dataProduct = EditProduct::find()->all();
            $basket = new CartItem();
            $dataPost = Yii::$app->request->post();

            if($dataPost['status'] == 'clear'){
                $basket->clearBasket();
                return $this->redirect(['products/cartitem']);
            }
            if($basket->removeItem($dataPost['id'])){
                return $this->redirect(['products/cartitem']);
            }
            if($dataPost['statusR'] == 1){
                $basket->addItem($dataPost['idR'], $dataPost['countR']);
            }

            return $this->render('cartitem',[
                'data' => $data,
                'dataProduct' => $dataProduct,
            ]);
        }
    }