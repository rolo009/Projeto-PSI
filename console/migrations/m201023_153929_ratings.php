<?php

use yii\db\Migration;

/**
 * Class m201023_153929_ratings
 */
class m201023_153929_ratings extends Migration
{
/*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_153929_ratings cannot be reverted.\n";

        return false;
    }
*/
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('ratings', [
            'id_rating' => $this->primaryKey(),
            'classificacao' => $this->integer()->notNull(),
            'pt_idPontoTuristico' => $this->integer()->notNull(),
            'user_idUtilizador' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-ratings-pt_idPontoTuristico',
            'ratings',
            'pt_idPontoTuristico'
        );
/*
        $this->addForeignKey(
            'fk-user-idUtilizador',
            'ratings',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );
*/
        $this->createIndex(
            'idx-ratings-user_idUtilizador',
            'ratings',
            'user_idUtilizador'
        );
/*
        $this->addForeignKey(
            'fk-PontoTuristico-idPontoTuristico',
            'ratings',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );*/
    }

    public function down()
    {
        /*$this->dropForeignKey(
            'fk-user-idUtilizador',
            'ratings'
        );

        $this->dropForeignKey(
            'fk-PontoTuristico-idPontoTuristico',
            'ratings'
        );*/

        $this->dropIndex(
            'idx-ratings-pt_idPontoTuristico',
            'ratings'
        );

        $this->dropIndex(
            'idx-ratings-user_idUtilizador',
            'ratings'
        );

        $this->dropTable('ratings');
    }
}
