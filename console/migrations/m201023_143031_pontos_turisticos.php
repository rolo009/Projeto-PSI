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
        $this->createTable('pontos_turisticos', [
            'id_pontoTuristico' => $this->int()->notNull()->unique(),
            'nome' => $this->string()->notNull(),
            'anoConstrucao' => $this->string(),
            'descricao' => $this->string()->notNull(),
            'foto' => $this->string(),
            'sexo' => $this->string()->notNull(),
            'id_user_rbac' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('pontos_turisticos');

    }
}
