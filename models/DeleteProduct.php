<?php

    namespace app\models;

    class DeleteProduct extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'products';
        }

        public function rules(){
            return [
                [['id'], 'required'],
                [['id'], 'string'],
            ];
        }
    }