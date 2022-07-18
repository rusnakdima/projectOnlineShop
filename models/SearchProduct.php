<?php

    namespace app\models;

    class SearchProduct extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'products';
        }

        public function rules(){
            return [
                [['product'], 'required'],
                [['product'], 'string', 'max' => 255],
            ];
        }
    }