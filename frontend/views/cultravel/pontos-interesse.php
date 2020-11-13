<?php
use yii\helpers\Html;
?>

<div class="pontos-interesse-container">
    <table style="width:50%">
        <tr>
            <th>Id Comentário</th>
            <th>Content</th>
            <th>Email</th>
        </tr>
        <tr>0
            <?php
            \yii\helpers\VarDumper::dump($dataProvider);
            ?>
        </tr>
    </table>
    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
            <h5>Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                4,8/5</p>
            <div>
                <?= Html::a('Saber Mais','/cultravel/pontoInteresseDetails' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','/cultravel/ponto-interesse-details' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/ponto-interesse-details' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/ponto-interesse-details' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/ponto-interesse-details' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/pontoInteresseDetails' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>

    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/pontoInteresseDetails' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>
</div>
