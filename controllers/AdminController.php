<?php

    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\EditCat;
    use app\models\EditOrder;
    use app\models\EditSubcat;
    use app\models\EditProduct;
    use app\models\SearchCat;
    use app\models\SearchSubcat;
    use app\models\SearchProduct;
    use app\models\SearchOrder;
    use app\models\DeleteCat;
    use app\models\DeleteSubcat;
    use app\models\DeleteProduct;
    use yii\data\Pagination;

    class AdminController extends Controller{
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
            return $this->render('index');
        }
        public function actionSubcatedit(){
            //Get data in table subcategories
            $dataSubcategory = EditSubcat::find();
            $pagesSubcategory = new Pagination(['totalCount' => $dataSubcategory->count(), 'pageSize' => 10]);
            $postsSubcategory = $dataSubcategory->offset($pagesSubcategory->offset)->limit($pagesSubcategory->limit)->all();

            $subcategoryEdit = new EditSubcat();
            $find = new SearchSubcat();
            $delItem = new DeleteSubcat();
            
            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            if($find->load(Yii::$app->request->post())){
                $text = $_POST['SearchSubcat']['subcategory'];
                $dataSubcategory = EditSubcat::find()->where(['like', 'subcategory', '%'.$text.'%', false]);
                $pagesSubcategory = new Pagination(['totalCount' => $dataSubcategory->count(), 'pageSize' => 10]);
                $postsSubcategory = $dataSubcategory->offset($pagesSubcategory->offset)->limit($pagesSubcategory->limit)->all();
            }

            if ($subcategoryEdit->load(Yii::$app->request->post()) && $subcategoryEdit->editSubcategory()) {
                return $this->redirect(['subcatedit']);
            }

            if($delItem->load(Yii::$app->request->post())){
                $values = explode(",", str_replace(" ", "", $_POST['DeleteSubcat']['id']));
                foreach($values as $val){
                    $delItem = DeleteSubcat::findOne($val);
                    $delItem->delete();
                }
                return $this->redirect(['subcatedit']);
            }

            return $this->render('subcatedit', [
                'dataSubcategory' => $postsSubcategory,
                'pagesSubcategory' => $pagesSubcategory,
                'subcategoryEdit' => $subcategoryEdit,
                'find' => $find,
                'delItem' => $delItem,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionCatedit(){
            //Get data in table Categories
            $dataCategory = EditCat::find();
            $pagesCategory = new Pagination(['totalCount' => $dataCategory->count(), 'pageSize' => 10]);
            $postsCategory = $dataCategory->offset($pagesCategory->offset)->limit($pagesCategory->limit)->all();

            $categoryEdit = new EditCat();
            $find = new SearchCat();
            $delItem = new DeleteCat();
            
            $category = (new \yii\db\Query())->from('categories')->all();

            if($find->load(Yii::$app->request->post())){
                $text = $_POST['SearchCat']['category'];
                $dataCategory = EditCat::find()->where(['like', 'category', '%'.$text.'%', false]);
                $pagesCategory = new Pagination(['totalCount' => $dataCategory->count(), 'pageSize' => 10]);
                $postsCategory = $dataCategory->offset($pagesCategory->offset)->limit($pagesCategory->limit)->all();
            }

            if ($categoryEdit->load(Yii::$app->request->post()) && $categoryEdit->editCategory()) {
                return $this->redirect(['catedit']);
            }

            if($delItem->load(Yii::$app->request->post())){
                $values = explode(",", str_replace(" ", "", $_POST['DeleteCat']['id']));
                foreach($values as $val){
                    $delItem = DeleteCat::findOne($val);
                    $delItem->delete();
                }
                return $this->redirect(['catedit']);
            }

            return $this->render('catedit', [
                'dataCategory' => $postsCategory,
                'pagesCategory' => $pagesCategory,
                'categoryEdit' => $categoryEdit,
                'find' => $find,
                'delItem' => $delItem,
                'category' => $category,
            ]);
        }
        public function actionProductedit(){
            //Get data in table Products
            $dataProduct = EditProduct::find();
            $pagesProduct = new Pagination(['totalCount' => $dataProduct->count(), 'pageSize' => 10]);
            $postsProduct = $dataProduct->offset($pagesProduct->offset)->limit($pagesProduct->limit)->all();

            $productEdit = new EditProduct();
            $find = new SearchProduct();
            $delItem = new DeleteProduct();
            
            $category = (new \yii\db\Query())->from('categories')->all();
            $subcategory = (new \yii\db\Query())->from('subcategories')->all();

            if($find->load(Yii::$app->request->post())){
                $text = $_POST['SearchProduct']['product'];
                $dataProduct = EditProduct::find()->where(['like', 'product', '%'.$text.'%', false]);
                $pagesProduct = new Pagination(['totalCount' => $dataProduct->count(), 'pageSize' => 10]);
                $postsProduct = $dataProduct->offset($pagesProduct->offset)->limit($pagesProduct->limit)->all();
            }

            if ($productEdit->load(Yii::$app->request->post()) && $productEdit->editProduct()) {
                return $this->redirect(['productedit']);
            }

            if($delItem->load(Yii::$app->request->post())){
                $values = explode(",", str_replace(" ", "", $_POST['DeleteProduct']['id']));
                foreach($values as $val){
                    $delItem = DeleteProduct::findOne($val);
                    $delItem->delete();
                }
                return $this->redirect(['productedit']);
            }

            return $this->render('productedit', [
                'dataProduct' => $postsProduct,
                'pagesProduct' => $pagesProduct,
                'productEdit' => $productEdit,
                'find' => $find,
                'delItem' => $delItem,
                'category' => $category,
                'subcategory' => $subcategory,
            ]);
        }
        public function actionOrderitem(){
            //Get data in table Orders
            $dataOrder = EditOrder::find();
            $pagesOrder = new Pagination(['totalCount' => $dataOrder->count(), 'pageSize' => 10]);
            $postsOrder = $dataOrder->offset($pagesOrder->offset)->limit($pagesOrder->limit)->all();
            
            $dataProduct = EditProduct::find()->all();
            $account = (new \yii\db\Query())->from('accounts')->all();
            $find = new SearchOrder();

            if($find->load(Yii::$app->request->post())){
                $text = $_POST['SearchOrder']['product_id'];
                $dataOrder = EditOrder::find()->where(['like', 'order', '%'.$text.'%', false]);
                $pagesOrder = new Pagination(['totalCount' => $dataOrder->count(), 'pageSize' => 10]);
                $postsOrder = $dataOrder->offset($pagesOrder->offset)->limit($pagesOrder->limit)->all();
            }

            return $this->render('orderItem', [
                'dataProduct' => $dataProduct,
                'dataOrder' => $postsOrder,
                'pagesOrder' => $pagesOrder,
                'find' => $find,
                'account' => $account,
            ]);
        }
    }