<?php

use yii\db\Migration;

/**
 * Class m201023_145426_localidade
 */
class m201023_145426_localidade extends Migration
{
    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_145426_localidade cannot be reverted.\n";

        return false;
    }
*/

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('localidade', [
            'id_localidade' => $this->primaryKey(),
            'nomeLocalidade' => $this->string()->notNull(),
        ],'ENGINE InnoDB');
    }

    public function down()
    {
        $this->dropTable('localidade');
    }
}
