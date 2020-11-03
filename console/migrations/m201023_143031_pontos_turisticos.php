<?php

use yii\db\Migration;

/**
 * Class m201023_143031_pontos_turisticos
 */
class m201023_143031_pontos_turisticos extends Migration
{
    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_143031_pontos_turisticos cannot be reverted.\n";

        return false;
    }
*/

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('pontosTuristicos', [
            'id_pontoTuristico' => $this->primaryKey(),
            'nome' => $this->string()->notNull()->notNull(),
            'anoConstrucao' => $this->string()->notNull(),
            'descricao' => $this->string()->notNull()->notNull(),
            'foto' => $this->string()->notNull(),
            'tm_idTipoMonumento' => $this->integer()->notNull(),
            'ec_idEstiloConstrucao' => $this->integer()->notNull(),
            'localidade_idLocalidade' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-tipoMonumento-idTipoMonumento',
            'pontosTuristicos',
            'tm_idTipoMonumento',
            'tipoMonumento',
            'idTipoMonumento',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-EstiloConstrucao-ec_idEstiloConstrucao',
            'pontosTuristicos',
            'ec_idEstiloConstrucao',
            'estiloConstrucao',
            'idEstiloConstrucao',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Localidade_idLocalidade',
            'pontosTuristicos',
            'localidade_idLocalidade',
            'localidade',
            'id_localidade',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey(
            'fk-tipoMonumento-idTipoMonumento',
            'PontosTuristicos'
        );

        $this->dropForeignKey(
            'fk-EstiloConstrucao-ec_idEstiloConstrucao',
            'PontosTuristicos'
        );

        $this->dropForeignKey(
            'fk-Localidade_idLocalidade',
            'PontosTuristicos'
        );

        $this->dropTable('pontosTuristicos');

    }
}
