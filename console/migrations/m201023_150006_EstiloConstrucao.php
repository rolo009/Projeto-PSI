<?php

use yii\db\Migration;

/**
 * Class m201023_150006_EstiloConstrucao
 */
class m201023_150006_EstiloConstrucao extends Migration
{
/*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_150006_EstiloConstrucao cannot be reverted.\n";

        return false;
    }
*/
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('estiloConstrucao', [
            'idEstiloConstrucao' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('estiloConstrucao');
    }

}
