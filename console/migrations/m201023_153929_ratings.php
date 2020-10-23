<?php

use yii\db\Migration;

/**
 * Class m201023_153929_ratings
 */
class m201023_153929_ratings extends Migration
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
        echo "m201023_153929_ratings cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('ratings', [
            'id_rating' => $this->int()->notNull()->unique(),
            'classificacao' => $this->integer()->notNull(),
            'user_id_ponto_turistico' => $this->integer()->notNull(),
            'user_id_utilizador' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-ratings_id',
            'ratings',
            'user_id_utilizador',
            'user',
            'id_rating',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ratings_id',
            'ratings',
            'user_id_ponto_turistico',
            'user',
            'id_rating',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('ratings');
    }
}
