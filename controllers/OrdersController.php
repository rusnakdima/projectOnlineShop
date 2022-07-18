<?php

    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\EditOrder;
    use app\models\EditProduct;
    use app\classes\CartItem;

    class OrdersController extends Controller{
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
        public function actionOrderedit(){
            $orderEdit = new EditOrder();
            $account = (new \yii\db\Query())->select('id')->from('accounts')->where(['username' => Yii::$app->user->identity->username])->one()['id'];
            $dataCart = CartItem::getCart();

            if ($orderEdit->load(Yii::$app->request->post()) && $orderEdit->editOrder()) {
                return $this->render('orderedit', [
                    'order' => $orderEdit,
                    'account' => $account,
                    'dataCart' => $dataCart,
                    'modalShow' => true,
                ]);
            }

            return $this->render('orderedit', [
                'order' => $orderEdit,
                'account' => $account,
                'dataCart' => $dataCart,
            ]);
        }
    }