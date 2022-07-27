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

            $sql = Yii::$app->db->createCommand("SHOW TABLES FROM `online_store`")->queryAll();
            $arr1 = [];
            $i = 0;
            foreach($sql as $key => $item){
                if(strripos($item['Tables_in_online_store'], 'pecific') > 0){
                    $arr1[$i] = $item['Tables_in_online_store'];
                    $i++;
                }
            }
            
            $arr2 = [];
            $i = 0;
            foreach($arr1 as $item){
                $filter = (new \yii\db\Query())->from($item)->all();
                foreach ($filter as $key => $value){
                    foreach ($value as $key1 => $value1){
                        $arr2[$key1][$i] = $value1;
                        $i++;
                        $arr2[$key1] = array_unique($arr2[$key1]);
                    }
                }
                unset($arr2['id']);
                unset($arr2['product_id']);
            }
            $filter = $arr2;

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

            if(Yii::$app->request->post()){
                //print_r(Yii::$app->request->post());
                $arr = Yii::$app->request->post();
                $str = '';
                foreach($arr as $key => $val) {
                    foreach($val as $key1 => $val1) {
                        if($str != '') $str .= ' AND ';
                        $str .= '`'.$key.'` = "'.$val1.'"';
                    }
                }
                $arr2 = [];
                $i = 0;
                foreach($arr1 as $item){
                    $arr2[$i] = (new \yii\db\Query())->from($item)->where($str)->all();
                    $i++;
                }
                $data = [];
                $k = 0;
                for($i = 0; $i < count($arr2); $i++){
                    for($j = 0; $j < count($arr2); $j++){
                        if($arr2[$i][$j]['product_id'] != ''){
                            $data[$k] = (new \yii\db\Query())->from('products')->where(['id' => $arr2[$i][$j]['product_id']])->one();
                            $k++;
                        }
                    }
                }
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
                'filter' => $filter,
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

            $filter = (new \yii\db\Query())->from('specific'.$_GET['item'])->all();
            $arr = [];
            $i = 0;
            foreach ($filter as $key => $value){
                foreach ($value as $key1 => $value1){
                    $arr[$key1][$i] = $value1;
                    $i++;
                    $arr[$key1] = array_unique($arr[$key1]);
                }
            }
            unset($arr['id']);
            unset($arr['product_id']);
            $filter = $arr;

            if ($_GET['sort'] == 'popularity'){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('count_add_cart DESC')->all();
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
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->all();
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
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('created_at DESC')->all();
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
            } else if($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc'){
                $data = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->from('categories')->where(['category'=>$_GET['item']])->one()['id']])->orderBy('price '.$_GET['sort'])->all();
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
            
            if(Yii::$app->request->post()){
                $arr = Yii::$app->request->post();
                $str = '';
                foreach($arr as $key => $val) {
                    foreach($val as $key1 => $val1) {
                        if($str != '') $str .= ' AND ';
                        $str .= '`'.$key.'` = "'.$val1.'"';
                    }
                }
                $arr1 = (new \yii\db\Query())->from('specific'.$_GET['item'])->where($str)->all();
                $data = [];
                //$filter = [];
                for($i = 0; $i < count($arr1); $i++){
                    $data[$i] = (new \yii\db\Query())->from('products')->where(['category'=>(new \yii\db\Query())->from('categories')->where(['category'=>$_GET['item']])->one()['id'], 'id' => $arr1[$i]['product_id']])->one();
                    //$filter[$i] = (new \yii\db\Query())->from('specific'.$_GET['item'])->where(['product_id' => $data[$i]['id']])->all()[0];
                }
                /*$arr = [];
                $i = 0;
                foreach ($filter as $key => $value){
                    foreach ($value as $key1 => $value1){
                        $arr[$key1][$i] = $value1;
                        $i++;
                        $arr[$key1] = array_unique($arr[$key1]);
                    }
                }
                unset($arr['id']);
                unset($arr['product_id']);
                $filter = $arr;*/
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
                'filter' => $filter,
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

            $nameTB = (new \yii\db\Query())->from('categories')->where(['id'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['category']])->one()['category'];
            $filter = (new \yii\db\Query())->from('specific'.$nameTB)->all();
            $arr = [];
            $i = 0;
            foreach ($filter as $key => $value){
                foreach ($value as $key1 => $value1){
                    $arr[$key1][$i] = $value1;
                    $i++;
                    $arr[$key1] = array_unique($arr[$key1]);
                }
            }
            unset($arr['id']);
            unset($arr['product_id']);
            $filter = $arr;
            
            if ($_GET['sort'] == 'popularity'){
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('count_add_cart DESC')->all();
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
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->all();
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
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('created_at DESC')->all();
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
                $data = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id']])->orderBy('price '.$_GET['sort'])->all();
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
            
            if(Yii::$app->request->post()){
                $arr = Yii::$app->request->post();
                $str = '';
                foreach($arr as $key => $val) {
                    foreach($val as $key1 => $val1) {
                        if($str != '') $str .= ' AND ';
                        $str .= '`'.$key.'` = "'.$val1.'"';
                    }
                }
                $arr1 = (new \yii\db\Query())->from('specific'.$nameTB)->where($str)->all();
                $data = [];
                for($i = 0; $i < count($arr1); $i++){
                    $data[$i] = (new \yii\db\Query())->from('products')->where(['subcategory'=>(new \yii\db\Query())->from('subcategories')->where(['subcategory'=>$_GET['item']])->one()['id'], 'id' => $arr1[$i]['product_id']])->one();
                }
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
                'filter' => $filter,
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