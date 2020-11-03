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
        $this->createTable('tipoMonumento', [
            'idTipoMonumento' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('tipoMonumento');
    }
}
