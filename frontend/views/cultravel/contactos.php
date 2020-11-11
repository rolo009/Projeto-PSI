<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Cultravel';
?>
<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png', ['class' => 'contact-img']); ?>

</div>
<div class="ct-ms-container">
    <div class="container-fluid">
        <div class="ct-ms-row">
            <div class="col- col-sm-7 col-md-auto col-{breakpoint}-auto">
                <div>
                    <h2>Como nos pode contactar?</h2>
                    <p>Para entrar em contacto conosco basta enviar-nos um email.</p>
                </div>
            </div>
            <div class="col- col-sm-5 col-md-auto col-{breakpoint}-auto">
                <div>

                    <h2>As redes sociais onde nos encontramos</h2>

                    <table>
                        <tr>

                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Twitter</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>