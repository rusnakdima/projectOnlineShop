<?php

    namespace app\models;

    class SearchSubcat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'subcategories';
        }

        public function rules(){
            return [
                [['subcategory'], 'required'],
                [['subcategory'], 'string', 'max' => 255],
            ];
        }
    }