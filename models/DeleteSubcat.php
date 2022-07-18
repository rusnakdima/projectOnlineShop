<?php

    namespace app\models;

    class DeleteSubcat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'subcategories';
        }

        public function rules(){
            return [
                [['id'], 'required'],
                [['id'], 'string'],
            ];
        }
    }