<?php

    namespace app\models;

    class EditCat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'categories';
        }

        public function rules(){
            return [
                [['category'], 'required'],
                [['category'], 'string', 'max' => 30],
                [['id'], 'integer'],
            ];
        }

        public function editCategory(){
            if (!$this->validate()) {
                return null;
            }

            if(self::find(['id' => $this->id])->exists()) {
                $data = self::find()->where(['id' => $this->id])->one();
            }
            if(!isset($data)) $data = new EditCat();

            $data->category = $this->category;
            
            return $data->save();
        }
    }