<?php

namespace app\modules\v1\controllers;

use common\models\User;
use common\models\Userprofile;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;

/**
 * UserprofileController implements the CRUD actions for Userprofile model.
 */
class UserprofileController extends Activecontroller
{
    public $modelClass = 'app\models\Userprofile';
    public $modelClassUser = 'app\models\User';

    public function actionBaniruser($id)
    {
        $statusBan = 0;

        $user =  User::findOne(['id' => $id]);

        if($user != null) {
            $user->status = $statusBan;
            $user->save();
            if($user->save() == true){
                return ['Utilizador com ID '. $id => 'Banido'];
            }
             }
        throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
    }

    public function actionInfo($id)
    {
        $user =  User::findOne(['id' => $id]);
        $userProfile =  Userprofile::findOne(['id_userProfile' => $id]);

        if($user != null && $userProfile != null) {

            return ['Utilizador' => [
                'ID Utilizador' => $userProfile->id_userProfile,
                'Nome' => $userProfile->primeiroNome . " " . $userProfile->ultimoNome,
                'Nome de Utilizador' => $user->username,
                'Email' => $user->email,
                'Data de Nascimento' => $userProfile->dtaNascimento,
                'Morada' => $userProfile->morada,
                'Localidade' => $userProfile->localidade,
                'Sexo' => $userProfile->sexo,
            ]];

             }
        else{
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");

        }
    }
}
