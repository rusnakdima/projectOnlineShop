<?php

    namespace app\models;

    class SearchCat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'categories';
        }

        public function rules(){
            return [
                [['category'], 'required'],
                [['category'], 'string', 'max' => 255],
            ];
        }
    }