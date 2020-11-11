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
                    <form action="/action_page.php">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Teu nome..">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="exemplo@mail.com">
                        <label for="assunto">Assunto</label>
                        <input type="text" id="assunto" name="assunto" placeholder="Assunto da mensagem">
                        <label for="subject">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" placeholder="Messagem que deseja enviar .." style="height:170px"></textarea>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="col- col-sm-5 col-md-auto col-{breakpoint}-auto">
                <div>

                    <h2>As redes sociais onde nos encontramos</h2>

                    <table>

                        <tr>
                            <th><img src="index/face-icon.png" class="contact-img" style="width:20%" ></th>
                            <th><img src="index/insta-icon.png" class="contact-img" style="width:20%" ></th>
                            <th><img src="index/tt-icon.png" class="contact-img" style="width:20%" ></th>
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