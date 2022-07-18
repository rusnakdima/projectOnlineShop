<?php

    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\Register;
    use app\models\LoginForm;

    class SiteController extends Controller{
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
        public function actionIndex(){
            $dataOrder = (new \yii\db\Query())->from('orders')->all();
            $arr = [];
            foreach($dataOrder as $item){
                if(array_key_exists($item['product_id'], $arr)){
                    $arr[$item['product_id']] += $item['count'];
                } else {
                    $arr[$item['product_id']] = $item['count'];
                }
            }
            $dataPopular = (new \yii\db\Query())->from('products')->orderBy('count_add_cart DESC')->limit(6)->all();
            $dataNewProduct = (new \yii\db\Query())->from('products')->orderBy('created_at DESC')->limit(6)->all();
            for($i = 0; $i < count($dataPopular); $i++){
                $dataPopular[$i]['orders'] = 0;
                $dataNewProduct[$i]['orders'] = 0;
            }
            foreach($dataPopular as $key => $item){
                foreach($arr as $key1 => $val){
                    if($item['id'] == $key1){
                        $dataPopular[$key]['orders'] = $val;
                    }
                }
            }
            foreach($dataNewProduct as $key => $item){
                foreach($arr as $key1 => $val){
                    if($item['id'] == $key1){
                        $dataNewProduct[$key]['orders'] = $val;
                    }
                }
            }

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            return $this->render('index', [
                'dataPopular' => $dataPopular,
                'dataNewProduct' => $dataNewProduct,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionLogin(){
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }
    
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
    
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        public function actionRegister(){
            $model = new Register();
    
            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                return $this->redirect(['login']);
            }
    
            return $this->render('register', [
                'model' => $model,
            ]);
        }
        public function actionLogout(){
            Yii::$app->user->logout();
    
            return $this->goHome();
        }
    }