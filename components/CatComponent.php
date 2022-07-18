<?php

    namespace app\components;

    use yii\base\Component;
    use yii\helpers\Html;

    class CatComponent extends Component{
        
        public function getData(){
            $data = (new \yii\db\Query())->from('categories')->all();
            //print_r($data);
            return $data;
        }
    }