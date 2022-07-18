<?php

    namespace app\models;

    class EditSubcat extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'subcategories';
        }

        public function rules(){
            return [
                [['subcategory', 'category'], 'required'],
                [['subcategory', 'category'], 'string', 'max' => 30],
                [['id'], 'integer'],
            ];
        }

        public function editSubcategory(){
            if (!$this->validate()) {
                return null;
            }

            if(self::find(['id' => $this->id])->exists()) {
                $data = self::find()->where(['id' => $this->id])->one();
            }
            if(!isset($data)) $data = new EditSubcat();

            $data->category = $this->category;
            $data->subcategory = $this->subcategory;
            
            return $data->save();
        }
    }