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

        // add "criarPi" permission
        $criarPi = $auth->createPermission('criarPi');
        $criarPi->description = 'Criar Ponto de Interesse';
        $auth->add($criarPi);

        // add "editarPi" permission
        $editarPi = $auth->createPermission('editarPi');
        $editarPi->description = 'Editar Ponto de Interesse';
        $auth->add($editarPi);

        // add "eliminarPi" permission
        $eliminarPi = $auth->createPermission('eliminarPi');
        $eliminarPi->description = 'Eliminar Ponto de Interesse';
        $auth->add($eliminarPi);

        // add "gerirUsers" permission
        $gerirUsers = $auth->createPermission('gerirUsers');
        $gerirUsers->description = 'Gerir Utilizadores';
        $auth->add($gerirUsers);

        // add "user" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $auth->add($user);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $criarPi);
        $auth->addChild($admin, $editarPi);
        $auth->addChild($admin, $eliminarPi);
        $auth->addChild($admin, $gerirUsers);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($user, 2);

    }

    public function down()
    {

        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
