<?php

    namespace app\models;

    class SearchOrder extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'orders';
        }

        public function rules(){
            return [
                [['order'], 'required'],
                [['order'], 'string', 'max' => 255],
            ];
        }
    }