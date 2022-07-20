<?php

use yii\db\Migration;

/**
 * Class m220712_094521_accounts
 */
class m220712_094521_accounts extends Migration
{
    /* public function up(){
        $this->createTable('accounts', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45),
            'password' => $this->string(64),
            'email' => $this->string(64),
            'auth_key' => $this->string(255),
            'access_token' => $this->string(255),
        ]);
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'category' => $this->text(),
        ]);
        $this->createTable('subcategories', [
            'id' => $this->primaryKey(),
            'subcategory' => $this->text(),
            'category' => $this->integer(),
        ]);
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'product' => $this->text(),
            'category' => $this->integer(),
            'subcategory' => $this->integer(),
            'price' => $this->integer(),
            'discount' => $this->integer(),
            'description' => $this->text(),
            'specifications' => $this->text(),
            'link' => $this->text(),
            'count_add_cart' => $this->integer(),
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',//$this->timestamp()->notNull()->defaultValue('CURRENT_TIMESTAMP'),
            'updated_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',//$this->timestamp()->notNull()->defaultValue('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
            'name' => $this->text(),
            'surname' => $this->text(),
            'date' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',//$this->timestamp()->notNull()->defaultValue(null),
            'address' => $this->text(),
            'phone' => $this->string(11),
            'email' => $this->text(),
            'count' => $this->integer(),
            'cost' => $this->integer(),
        ]);
        $this->createTable('source_message', [
            'id' => $this->primaryKey(),
            'category' => $this->string(),
            'message' => $this->text(),
        ]);
        $this->createIndex(
            'idx-source_message_category',
            'source_message',
            'category'
        );
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'language' => $this->string(16),
            'translation' => $this->text(),
        ]);
        $this->addForeignKey(
            'fk-message_source_message',
            'message',
            'id',
            'source_message',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-message_language',
            'message',
            'language'
        );
        $this->addForeignKey(
            'fk-products-categories-id',
            'products',
            'category',
            'categories',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-products-subcategories-id',
            'products',
            'subcategory',
            'subcategories',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-subcategories-categories-id',
            'subcategories',
            'category',
            'categories',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-orders-products-id',
            'orders',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-orders-accounts-id',
            'orders',
            'user_id',
            'accounts',
            'id',
            'CASCADE'
        );
    }

    public function down(){
        $this->dropForeignKey(
            'fk-products-categories-id',
            'products'
        );
        $this->dropForeignKey(
            'fk-products-subcategories-id',
            'products'
        );
        $this->dropForeignKey(
            'fk-subcategories-categories-id',
            'subcategories'
        );
        $this->dropForeignKey(
            'fk-orders-products-id',
            'orders'
        );
        $this->dropForeignKey(
            'fk-orders-accounts-id',
            'orders'
        );
        $this->dropForeignKey(
            'fk-message_source_message',
            'orders'
        );
        $this->dropIndex(
            'idx-source_message_category',
            'orders'
        );
        $this->dropIndex(
            'idx-message_language',
            'orders'
        );
        $this->dropTable('accounts');
        $this->dropTable('orders');
        $this->dropTable('categories');
        $this->dropTable('subcategories');
        $this->dropTable('products');
        $this->dropTable('source_message');
        $this->dropTable('message');
        return false;
    }
    public function safeUp(){}

    public function safeDown(){} */
}
