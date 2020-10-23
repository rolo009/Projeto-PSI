<?php

use yii\db\Migration;

/**
 * Class m201023_145647_favoritos
 */
class m201023_145647_favoritos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201023_145647_favoritos cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('favoritos', [
            'id_favoritos' => $this->int()->notNull()->unique(),
            'pt_ponto_turistico' => $this->integer()->notNull(),
            'user_id_utilizador' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-favoritos_id',
            'favoritos',
            'user_id_utilizador',
            'favoritos',
            'id_favoritos',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favoritos_id',
            'favoritos',
            'pt_ponto_turistico',
            'favoritos',
            'id_favoritos',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('favoritos');
    }
}
