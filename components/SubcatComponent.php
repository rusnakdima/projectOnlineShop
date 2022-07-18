<?php

    namespace app\components;

    use yii\base\Component;
    use yii\helpers\Html;

    class SubcatComponent extends Component{
        
        public function getData(){
            $data = (new \yii\db\Query())->from('subcategories')->all();
            return $data;
        }
    }