<?php

use yii\db\Migration;

/**
 * Class m201023_152554_TipoMonumento
 */
class m201023_152554_TipoMonumento extends Migration
{
/*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_152554_TipoMonumento cannot be reverted.\n";

        return false;
    }

    */
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tipoMonumento}}', [
            'idTipoMonumento' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('tipoMonumento');
    }
}
