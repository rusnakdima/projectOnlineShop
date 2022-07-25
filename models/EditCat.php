<?php

    namespace app\models;
    use Yii;

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
            if(!isset($data)) {
                $data = new EditCat();
                $sql = "CREATE TABLE specific".$this->category."(id INT NOT NULL, product_id INT, brand text, PRIMARY KEY (id));";
                Yii::$app->db->createCommand($sql)->execute();
                $sql = "ALTER TABLE `specific".$this->category."` ADD CONSTRAINT `fk-specific".$this->category."-products-id` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;";
                Yii::$app->db->createCommand($sql)->execute();
            }

            $data->category = $this->category;
            
            return $data->save();
        }
    }