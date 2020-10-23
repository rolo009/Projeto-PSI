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
        $this->createTable('PontosTuristicos', [
            'id_pontoTuristico' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'anoConstrucao' => $this->string(),
            'descricao' => $this->string()->notNull(),
            'foto' => $this->string(),
            'sexo' => $this->string()->notNull(),
            'id_user_rbac' => $this->integer()->notNull(),
            'tm_idTipoMonumento' => $this->integer()->notNull(),
            'ec_idEstiloConstrucao' => $this->integer()->notNull(),
            'localidade_idLocalidade' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-tipoMonumento-idTipoMonumento',
            'PontosTuristicos',
            'tm_idTipoMonumento',
            'TipoMonumento',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-EstiloConstrucao-ec_idEstiloConstrucao',
            'PontosTuristicos',
            'ec_idEstiloConstrucao',
            'EstiloConstrucao',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Localidade_idLocalidade',
            'PontosTuristicos',
            'localidade_idLocalidade',
            'Localidade',
            'id',
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

        $this->dropTable('PontosTuristicos');

    }
}
