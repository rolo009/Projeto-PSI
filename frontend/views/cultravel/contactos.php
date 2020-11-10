<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Cultravel';
?>

<div class="contact-logo-index-container">

    <?= Html::img('@web/seta-logo.png'); ?>

</div>

<div class="contact-container">




    <div >

        <h2>Como nos pode contactar?</h2>
        <div class="ct-ms-container">
            <div class="ct-ms-column">
                <form action="/action_page.php">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Emanuel/a Rocha">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" placeholder="Assunto a que se refere ">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@mail.com">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" placeholder="Escreva aqui a sua menssagem" style="height:170px"></textarea>
                    <input class="btn btn-warning" type="submit" value="Submit">
                </form>
            </div>
        </div>

    </div>
    <div >


        <h3>As redes sociais onde nos encontramos</h3>

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


        <div>




        </div>