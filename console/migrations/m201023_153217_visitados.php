<?php

use yii\db\Migration;

/**
 * Class m201023_153217_visitados
 */
class m201023_153217_visitados extends Migration
{

   /*

     public function safeUp()
    {

    }

    public function safeDown()
    {

    }
   */

    public function up()
    {
       $this->createTable('visitados', [
            'id_visitados' => $this->primaryKey(),
            'user_idUtilizador' => $this->integer()->notNull(),
            'pt_idPontoTuristico' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'fk-user-idUtilizador',
            'visitados',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-PontoTuristico-id_pontoTuristico',
            'visitados',
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
            'visitados'
        );

        $this->dropForeignKey(
            'fk-PontoTuristico-id_pontoTuristico',
            'visitados'
        );

        $this->dropTable('visitados');

    }
}
