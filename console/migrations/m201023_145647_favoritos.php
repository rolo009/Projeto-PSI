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

        $this->createIndex(
            'idx-favoritos-user_idUtilizador',
            'favoritos',
            'user_idUtilizador'
        );
/*
        $this->addForeignKey(
            'fk-user-idUtilizador',
            'favoritos',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );
*/
        $this->createIndex(
            'idx-favoritos-pt_idPontoTuristico',
            'favoritos',
            'pt_idPontoTuristico'
        );
/*
        $this->addForeignKey(
            'fk-pontoTuristico-idPontoTuristico',
            'favoritos',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );*/
    }

    public function down()
    {
        /*
        $this->dropForeignKey(
            'fk-user-idUtilizador',
            'Favoritos'
        );

        $this->dropForeignKey(
            'fk-pontosTuristicos-idPontoTuristico',
            'Favoritos'
        );
*/
        $this->dropIndex(
            'idx-favoritos-user_idUtilizador',
            'favoritos'
        );

        $this->dropIndex(
            'idx-favoritos-pt_idPontoTuristico',
            'favoritos'
        );
        $this->dropTable('favoritos');
    }
}
