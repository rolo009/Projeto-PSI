<?php

use yii\db\Migration;

/**
 * Class m201023_145647_favoritos
 */
class m201023_145647_favoritos extends Migration
{
/*
    public function safeUp()
    {

    }


    public function safeDown()
    {
        echo "m201023_145647_favoritos cannot be reverted.\n";

        return false;
    }
*/

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('favoritos', [
            'id_favoritos' => $this->primaryKey(),
            'pt_idPontoTuristico' => $this->integer()->notNull(),
            'user_idUtilizador' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-idUtilizador',
            'favoritos',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-pontosTuristicos-idPontoTuristico',
            'favoritos',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-user-idUtilizador',
            'Favoritos'
        );

        $this->dropForeignKey(
            'fk-pontosTuristicos-idPontoTuristico',
            'Favoritos'
        );

        $this->dropTable('favoritos');
    }
}
