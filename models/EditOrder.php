<?php

    namespace app\models;

    class EditOrder extends \yii\db\ActiveRecord{

        public static function tableName(){
            return 'orders';
        }

        public function rules(){
            return [
                [['name', 'surname', 'address', 'phone', 'email'], 'required'],
                [['id', 'user_id'], 'integer'],
                [['product_id', 'count', 'cost', 'name', 'surname', 'address', 'email'], 'string'],
                [['phone'], 'string', 'max' => 11],
            ];
        }

        public function editOrder(){
            if (!$this->validate()) {
                return null;
            }

            $arr = explode(",", str_replace(" ", "", $this->product_id));
            array_pop($arr);
            $arr1 = explode(",", str_replace(" ", "", $this->count));
            array_pop($arr1);
            $arr2 = explode(",", str_replace(" ", "", $this->cost));
            array_pop($arr2);

            for($i = 0; $i < count($arr); $i++){
                $data = new EditOrder();
                $data->product_id = $arr[$i];
                $data->user_id = $this->user_id;
                $data->name = $this->name;
                $data->surname = $this->surname;
                $data->date = date("Y-m-d H:i:s");
                $data->address = $this->address;
                $data->phone = $this->phone;
                $data->email = $this->email;
                $data->count = $arr1[$i];
                $data->cost = $arr2[$i];
                $data->save();
            }
            
            return 1;
        }
    }