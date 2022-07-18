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
            $dataPopular = (new \yii\db\Query())->from('products')->all();
            $dataNewProduct = (new \yii\db\Query())->select('created_at')->from('products')->all();
            $arr = [];
            $j = 0;
            for($i = 0; $i < count($dataNewProduct); $i++){
                if(date("Y-m", strtotime($dataNewProduct[$i]['created_at'])) == date("Y-m")){
                    $arr[$j] = ((new \yii\db\Query())->from('products')->where(['created_at' => $dataNewProduct[$i]['created_at']])->all()[0]);
                    $j++;
                }
            }

            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            return $this->render('index', [
                'dataPopular' => $dataPopular,
                'dataNewProduct' => $arr,
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