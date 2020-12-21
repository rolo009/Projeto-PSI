<?php

use yii\db\Migration;


class m201104_145257_permissions extends Migration
{
    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201104_145257_permissions cannot be reverted.\n";

        return false;
    }
    */
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        $criarPi = $auth->createPermission('criarPi');
        $criarPi->description = 'Criar Ponto de Interesse';
        $auth->add($criarPi);

        $editarPi = $auth->createPermission('editarPi');
        $editarPi->description = 'Editar Ponto de Interesse';
        $auth->add($editarPi);

        $eliminarPi = $auth->createPermission('eliminarPi');
        $eliminarPi->description = 'Eliminar Ponto de Interesse';
        $auth->add($eliminarPi);

        $gerirUsers = $auth->createPermission('gerirUsers');
        $gerirUsers->description = 'Gerir Utilizadores';
        $auth->add($gerirUsers);

        $gerirCargos = $auth->createPermission('gerirCargos');
        $gerirCargos->description = 'Gerir Cargos Administrativos';
        $auth->add($gerirCargos);

        $gerirMensagens = $auth->createPermission('gerirMensagens');
        $gerirMensagens->description = 'Gerir Mensagens';
        $auth->add($gerirMensagens);

        $editarEstadoMensagens = $auth->createPermission('editarEstadoMensagens');
        $editarEstadoMensagens->description = 'Editar Estado Mensagens';
        $auth->add($editarEstadoMensagens);

        $user = $auth->createRole('user');
        $auth->add($user);

        $moderador = $auth->createRole('moderador');
        $auth->add($moderador);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($moderador, $gerirUsers);
        $auth->addChild($moderador, $criarPi);
        $auth->addChild($moderador, $editarPi);
        $auth->addChild($moderador, $gerirMensagens);
        $auth->addChild($moderador, $editarEstadoMensagens);
        $auth->addChild($admin, $moderador);
        $auth->addChild($admin, $gerirCargos);
        $auth->addChild($admin, $eliminarPi);

        $auth->assign($admin, 1);
    }

    public function down()
    {

        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
