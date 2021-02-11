<?php

use scotthuangzl\googlechart\GoogleChart;
use yii\helpers\Html;
$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Estatísticas Utilizadores';

?>
<div class="stats-user-container">
    <?= Html::img('imagens/logo/seta-logo.png', ['class' => 'logo-stats']); ?>
    <div class="estatisticas-info">ESTATÍSTICAS</div>
    <div class="card-stats">
        <?php
        echo GoogleChart::widget(array('visualization' => 'PieChart',
            'data' => array(
                array('Task', 'Hours per Day'),
                array('Sexo Masculino', (int)$nUsersMasculinos),
                array('Sexo Feminino', (int)$nUsersFemininos)
            ),
            'options' => ['title' => 'Estatistica de Géneros',
                 'colors'=> ['#f6504b']]));

        ?>
    </div>
    <div class="idades-container">

        <?= GoogleChart::widget(array('visualization' => 'ColumnChart',
            'data' => array(
                array('Tarefa', 'Nº de Utilizadores'),
                array('Idades (0 - 20)', $idadesUsers['idade0a20']),
                array('Idades (20 - 30)', $idadesUsers['idade20a30']),
                array('Idades (30 - 40)', $idadesUsers['idade30a40']),
                array('Idades (40 - 60)', $idadesUsers['idade40a60']),
                array('Idades (60 - 75)', $idadesUsers['idade60a75']),
                array('Idades (75+)', $idadesUsers['idadeMais75']),
            ),
            'options' => ['title' => 'Idades de Utilizadores Registados',
                'colors'=> ['#f6504b']]));

        ?>
    </div>

    <div class="distritos-container">

        <?= GoogleChart::widget(array('visualization' => 'ColumnChart',
            'data' => array(
                array('Tarefa', 'Nº de Utilizadores'),
                array('Viana do Castelo', $distritosUsers['VianaDoCastelo']),
                array('Braga', $distritosUsers['Braga']),
                array('Vila Real', $distritosUsers['VilaReal']),
                array('Bragança', $distritosUsers['Braganca']),
                array('Porto', $distritosUsers['Porto']),
                array('Aveiro', $distritosUsers['Aveiro']),
                array('Viseu', $distritosUsers['Viseu']),
                array('Guarda', $distritosUsers['Guarda']),
                array('Coimbra', $distritosUsers['Coimbra']),
                array('Castelo Branco', $distritosUsers['CasteloBranco']),
                array('Leiria', $distritosUsers['Leiria']),
                array('Santarém', $distritosUsers['Santarem']),
                array('Portalegre', $distritosUsers['Portalegre']),
                array('Lisboa', $distritosUsers['Lisboa']),
                array('Évora', $distritosUsers['Evora']),
                array('Setubal', $distritosUsers['Setubal']),
                array('Beja', $distritosUsers['Beja']),
                array('Faro', $distritosUsers['Faro']),
                array('Açores', $distritosUsers['Acores']),
                array('Madeira', $distritosUsers['Madeira']),
            ),
            'options' => ['title' => 'Número de utilizadores por distrito',
                'colors'=> ['#f6504b']]));

        ?>
    </div>
</div>
