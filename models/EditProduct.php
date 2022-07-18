<?php

    namespace app\models;

    class EditProduct extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'products';
        }

        public function rules(){
            return [
                [['product', 'category', 'subcategory', 'price', 'discount'], 'required'],
                [['product', 'link'], 'string', 'max' => 255],
                [['id', 'count_add_cart'], 'integer'],
                [['description', 'specifications'], 'string'],
            ];
        }

        public function editProduct(){
            if (!$this->validate()) {
                return null;
            }

            if(self::find(['id' => $this->id])->exists()) {
                $data = self::find()->where(['id' => $this->id])->one();
            }
            if(!isset($data)) {
                $data = new EditProduct();
                $data->created_at = date("Y-m-d H:i:s");
            }

            $data->product = $this->product;
            $data->category = $this->category;
            $data->subcategory = $this->subcategory;
            $data->price = $this->price;
            $data->discount = $this->discount;
            $data->description = $this->description;
            $data->specifications = $this->specifications;
            $data->link = $this->link;
            $data->count_add_cart = 0;
            $data->updated_at = date("Y-m-d H:i:s");

            return $data->save();
        }
    }