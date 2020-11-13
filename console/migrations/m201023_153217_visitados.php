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

        $this->createIndex(
            'idx-visitados-user_idUtilizador',
            'visitados',
            'user_idUtilizador'
        );

       /*
        $this->addForeignKey(
            'fk-user-idUtilizador',
            'visitados',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );*/

        $this->createIndex(
            'idx-visitados-pt_idPontoTuristico',
            'visitados',
            'pt_idPontoTuristico'
        );

        /*
        $this->addForeignKey(
            'fk-PontoTuristico-id_pontoTuristico',
            'visitados',
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
            'visitados'
        );

        $this->dropForeignKey(
            'fk-PontoTuristico-id_pontoTuristico',
            'visitados'
        );
*/
        $this->dropIndex(
            'idx-visitados-user_idUtilizador',
            'visitados'
        );

        $this->dropIndex(
            'idx-visitados-pt_idPontoTuristico',
            'visitados'
        );
        $this->dropTable('visitados');

    }
}
