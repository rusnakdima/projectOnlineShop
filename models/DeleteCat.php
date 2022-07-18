<?php

    namespace app\models;

    class DeleteCat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'categories';
        }

        public function rules(){
            return [
                [['id'], 'required'],
                [['id'], 'string'],
            ];
        }
    }