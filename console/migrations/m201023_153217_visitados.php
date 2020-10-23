<?php

use yii\db\Migration;

/**
 * Class m201023_153217_visitados
 */
class m201023_153217_visitados extends Migration
{
    /**
     * {@inheritdoc}
     */
   /* public function safeUp()
    {

    }*/

    /**
     * {@inheritdoc}
     */
   /* public function safeDown()
    {
        echo "m201023_153217_visitados cannot be reverted.\n";

        return false;
    }*/
    public function up()
    {
        $this->createTable('visitados', [
            'id_visitados' => $this->primaryKey(),
            'user_id_utilizador' => $this->integer()->notNull(),
            'id_pontoTuristico' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'fk-user_id_utilizador',
            'user',
            'id_user_rbac',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-id_pontoTuristico',
            'pontos_turisticos',
            'id_user_rbac',
            'user',
            'id',
            'CASCADE'
        );

    }
    public function down()
    {
        $this->dropTable('visitados');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201023_153217_visitados cannot be reverted.\n";

        return false;
    }
    */
}
