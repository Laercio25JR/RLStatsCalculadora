<script type="text/javascript">

    $('#modal-title').text('<?= ($PlayerName == "") ? "Career Stats" : $PlayerName ?>');

</script>

<?php
    function GetScoreColor($score){

        $score = number_format($score, 0);

        if($score >= 75){           //SLL
            return 'stext-SSL';
        } else if($score >= 45){    //GC
            return 'stext-GC';
        } else if($score >= 35) {   //Champ
            return 'stext-C';
        } else if($score >= 25) {   //Diamond
            return 'stext-D';
        } else if($score >= 15) {   //Plat
            return 'stext-PL';
        } else if($score >= 10) {   // Gold
            return 'stext-G';
        } else if($score >= 5) {    //Silver
            return 'stext-S';
        } else {                    //Bronze
            return 'stext-B';
        }
    }

    function GetRankIcon($Score) {
        $ScoreStyle = GetScoreColor($Score);
        $IconPath = explode("-", $ScoreStyle);
        return $IconPath[1];
    }

    function GetRankDescription($Score) {
        $RankTitle = GetRankIcon($Score);

        switch ($RankTitle) {
            case 'B':
                return 'Bronze';
                break;
            case 'S':
                return 'Prata';
                break;
            case 'G':
                return 'Ouro';
                break;
            case 'PL':
                return 'Platina';
                break;
            case 'D':
                return 'Diamante';
                break;
            case 'C':
                return 'Campeão';
                break;
            case 'GC':
                return 'Supercampeão';
                break;
            case 'SSL':
                return 'Lenda Supersônica';
                break;
            default:
                return '';
                break;
        }
    }
?>

<div class="container-fluid m-0 p-0">
    <div class="container w-50 float-left">
        
        <div class="">
            <a style="font-size: 1.2rem;" title="Pontuação geral baseado nas outras habilidades. De todas, essa é a que representa melhor a habilidade do jogador">Habilidade Geral: </a>
            <a style="font-size: 1.2rem;" class="<?= GetScoreColor($OVR_Stats[0]) ?>"><?php echo number_format($OVR_Stats[0], 0); ?></a>
            <img src="View/_images/<?= GetRankIcon($OVR_Stats[0]) ?>_icon.png" style="height: 1.7rem;" class="mb-1 ml-1" 
            title="<?= GetRankDescription($OVR_Stats[0]) ?>"></img><br><br>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a>Chute: </a>
                <a class="<?= GetScoreColor($OVR_Stats[1]) ?>"><?php echo number_format($OVR_Stats[1], 0); ?></a><br>
                <a>Passe: </a>
                <a class="<?= GetScoreColor($OVR_Stats[2]) ?>"><?php echo number_format($OVR_Stats[2], 0); ?></a><br>
                <a>Pressão: </a>
                <a class="<?= GetScoreColor($OVR_Stats[3]) ?>"><?php echo number_format($OVR_Stats[3], 0); ?></a><br>
            </div>
            <div class="col-md-6 pl-0">
                <a>Defesa: </a>
                <a class="<?= GetScoreColor($OVR_Stats[4]) ?>"><?php echo number_format($OVR_Stats[4], 0); ?></a><br>
                <a>Drible: </a>
                <a class="<?= GetScoreColor($OVR_Stats[5]) ?>"><?php echo number_format($OVR_Stats[5], 0); ?></a><br>
                <a>Aéreo: </a>
                <a class="<?= GetScoreColor($OVR_Stats[6]) ?>"><?php echo number_format($OVR_Stats[6], 0); ?></a><br><br>
            </div>
        </div>

        <a>Decisivo: </a>
        <a class="<?= GetScoreColor($OVR_Stats[7]) ?>"><?php echo number_format($OVR_Stats[7], 0); ?></a><br>
        <a title="A precisão representa quantas vezes as suas jogadas terminam em um gol ou assistência."
        >Precisão: <?php echo number_format(($OVR_Stats[8] * 100 ), 0).'%'; ?></a>
        <a><?php 
            if ($OVR_Stats[8] > 0.55) 
                echo '(Bom)';

            else if ($OVR_Stats[8] > 0.50)
                echo '(Mediano)';

            else echo '(Ruim)';

        ?></a><br><br>

        <a style="font-size: 1.2rem;">Arquétipos:</a><br>
        <a><?php echo '- '.$OVR_Stats[9]; ?> </a>
        <a><?php echo number_format(floatval($OVR_Stats[10]), 0); ?>%</a><br>
        <a><?php echo '- '.$OVR_Stats[11]; ?> </a>
        <a><?php echo number_format(floatval($OVR_Stats[12]), 0); ?>%</a><br>
        <a><?php echo '- '.$OVR_Stats[13]; ?> </a>
        <a><?php echo number_format(floatval($OVR_Stats[14]), 0); ?>%</a><br>
        <a><?php echo '- '.$OVR_Stats[15]; ?> </a>
        <a><?php echo number_format(floatval($OVR_Stats[16]), 0); ?>%</a><br><br>
    </div>

    <div class="w-50 float-right">
        <a style="font-size: 1.2rem;">Seu estilo de jogo é: <b><?= $PlayStyle ?></b></a>
    </div>

    <div class="container w-50 mt-4 float-right">
        <canvas id="myChart"></canvas>
        <button type="button" class="btn btn-outline-primary float-right" onclick="toggleZoom()">Zoom</button>
    </div>
</div>


<script type="text/javascript">
    var defaultZoom = 100;
    var isZoomed = false;

    var Shoot = <?= number_format($OVR_Stats[1], 0) ?>;
    var Pass = <?= number_format($OVR_Stats[2], 0)?>;
    var Pression = <?= number_format($OVR_Stats[3], 0)?>;
    var Defense = <?= number_format($OVR_Stats[4], 0)?>;
    var Drible = <?= number_format($OVR_Stats[5], 0)?>;
    var Aerial = <?= number_format($OVR_Stats[6], 0)?>;

    // Dados
    var data = [Shoot, Pass, Pression, Defense, Drible, Aerial];

    // Inicializar o gráfico
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Chute', 'Passe', 'Presão', 'Defesa', 'Drible', 'Aéreo'],
            datasets: [{
                label: 'Pontuação',
                data: data,
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                r: {
                    min: 0,
                    max: defaultZoom,
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)'
                    },
                    angleLines: {
                        color: 'rgba(255, 255, 255, 0.2)'
                    },
                    pointLabels: {
                        color: '#ffffff'
                    },
                    ticks: {
                        color: '#ffffff',
                        backdropColor: 'rgba(0, 0, 0, 0)'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff'
                    }
                }
            },
            animation: {
                duration: 1000  
            }
        }
    });

    function toggleZoom() {
        var maxValue = Math.max(...data) +  5; 

        if (!isZoomed) {
            myChart.options.scales.r.max = maxValue;
        } else {
            myChart.options.scales.r.max = defaultZoom;
        }
        
        isZoomed = !isZoomed;
        myChart.update();
    }

    $('#modalExemplo').on('shown.bs.modal', function () {
        myChart.reset();  // Reinicia a animação
        myChart.update();  // Atualiza o gráfico para forçar a animação
    });
</script>