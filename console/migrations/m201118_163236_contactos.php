<?php

use yii\db\Migration;

/**
 * Class m201118_163236_contactos
 */
class m201118_163236_contactos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('contactos', [
            'idContactos' => $this->primaryKey(),
            'nome' => $this->string()->notNull()->notNull(),
            'email' => $this->string()->notNull(),
            'assunto' => $this->string(60)->notNull()->notNull(),
            'mensagem' => $this->string(6000)->notNull()->notNull(),
            'data' => $this->dateTime(),
        ]);

    }

    public function down()
    {
        $this->dropTable('contactos');
    }

    /*public function safeDown()
    {
        echo "m201118_163236_contactos cannot be reverted.\n";

        return false;
    }
    */
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }


    */
}
