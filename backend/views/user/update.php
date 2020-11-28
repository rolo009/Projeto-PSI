 <?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Atualizar Utilizador: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="user-update">

    <h3 class="info-user" >
        <?= "Atualizar estado do utilizador: ". $model->username ?>
    </h3>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
