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
            'idcontactos' => $this->primaryKey(),
            'nome' => $this->string()->notNull()->notNull(),
            'email' => $this->string()->notNull(),
            'subject' => $this->string(60)->notNull()->notNull(),
            'body' => $this->string(6000)->notNull()->notNull(),
            'data' => $this->dateTime(),
            'id_user_rbac' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-idcontactos-id_user_rbac',
            'userProfile',
            'id_user_rbac'
        );

    }

    public function down()
    {
        $this->dropIndex(
            'idx-idcontactos-id_user_rbac',
            'userProfile'
        );
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
