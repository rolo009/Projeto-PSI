<?php

use yii\db\Migration;

/**
 * Class m201023_141002_user_profile
 */
class m201023_141002_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_141002_user_profile cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('UserProfile', [
            'primeiroNome' => $this->string()->notNull(),
            'ultimoNome' => $this->string()->notNull(),
            'dtaNascimento' => $this->date()->notNull(),
            'morada' => $this->string()->notNull(),
            'localidade' => $this->string()->notNull(),
            'sexo' => $this->string()->notNull(),
            'id_user_rbac' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user_profile_id',
            'UserProfile',
            'id_user_rbac',
            'user',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {

        $this->dropForeignKey(
            'fk-user_profile_id',
            'UserProfile'
        );

        $this->dropTable('UserProfile');
    }



}
