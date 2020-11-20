<?php

use yii\db\Migration;

class m201111_150948_fk extends Migration
{
    /*
        public function safeUp()
        {

        }

        public function safeDown()
        {
            echo "m201111_150948_fk cannot be reverted.\n";

            return false;
        }

    */
    public function up()
    {

        /*----------------User Profile---------------*/

        $this->addForeignKey(
            'fk-user_profile-id',
            'userProfile',
            'id_user_rbac',
            'user',
            'id',
            'CASCADE'
        );

        /*----------------Contactos---------------*/
        $this->addForeignKey(
            'fk-idcontactos-id',
            'contactos',
            'id_user_rbac',
            'user',
            'id',
            'CASCADE'
        );


        /*----------------Pontos Turisticos---------------*/

        $this->addForeignKey(
            'fk-pontosTuristicos-idTipoMonumento',
            'pontosTuristicos',
            'tm_idTipoMonumento',
            'tipoMonumento',
            'idTipoMonumento',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-pontosTuristicos-ec_idEstiloConstrucao',
            'pontosTuristicos',
            'ec_idEstiloConstrucao',
            'estiloConstrucao',
            'idEstiloConstrucao',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-pontosTuristicos-localidade_idLocalidade',
            'pontosTuristicos',
            'localidade_idLocalidade',
            'localidade',
            'id_localidade',
            'CASCADE'
        );
        /*----------------Favoritos---------------*/

        $this->addForeignKey(
            'fk-favoritos-idUtilizador',
            'favoritos',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favoritos-idPontoTuristico',
            'favoritos',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );

        /*----------------Visitados---------------*/

        $this->addForeignKey(
            'fk-visitados-idUtilizador',
            'visitados',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-visitados-id_pontoTuristico',
            'visitados',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );

        /*----------------Ratings---------------*/

        $this->addForeignKey(
            'fk-ratings-idUtilizador',
            'ratings',
            'user_idUtilizador',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ratings-idPontoTuristico',
            'ratings',
            'pt_idPontoTuristico',
            'pontosTuristicos',
            'id_pontoTuristico',
            'CASCADE'
        );
    }


    public function down()
    {
        /*----------------User Profile---------------*/

        $this->dropForeignKey(
            'fk-user_profile_id',
            'userProfile'
        );

        /*----------------Contactos---------------*/

        $this->dropForeignKey(
            'fk-idcontactos_id',
            'contactos'
        );

        /*----------------Pontos Turisticos---------------*/

        $this->dropForeignKey(
            'fk-tipoMonumento-idTipoMonumento',
            'pontosTuristicos'
        );

        $this->dropForeignKey(
            'fk-EstiloConstrucao-ec_idEstiloConstrucao',
            'pontosTuristicos'
        );

        $this->dropForeignKey(
            'fk-pontosTuristicos-localidade_idLocalidade',
            'pontosTuristicos'
        );

        /*----------------Favoritos---------------*/

        $this->dropForeignKey(
            'fk-favoritos-idUtilizador',
            'favoritos'
        );

        $this->dropForeignKey(
            'fk-favoritos-idPontoTuristico',
            'favoritos'
        );

        /*----------------Visitados---------------*/
        $this->dropForeignKey(
            'fk-visitados-idUtilizador',
            'visitados'
        );

        $this->dropForeignKey(
            'fk-visitados-id_pontoTuristico',
            'visitados'
        );

        /*----------------Ratings---------------*/

        $this->dropForeignKey(
            'fk-ratings-idUtilizador',
            'ratings'
        );

        $this->dropForeignKey(
            'fk-ratings-idPontoTuristico',
            'ratings'
        );
    }
}
