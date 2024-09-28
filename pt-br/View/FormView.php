<script type="text/javascript">

//------------------------------------------------
function updateRank1v1Field() {
    var selectedRank = $('#max1v1Rank').val();
    if (selectedRank == '1') { 
        $('#rank1v1DivContainer').html('<input type="number" class="form-control bg-darker" id="max1v1RankMMR" name="max1v1RankMMR" placeholder="Insira o MMR" required>');
    } else {
        $('#rank1v1DivContainer').html('<select class="form-control bg-darker" id="max1v1RankDiv" name="max1v1RankDiv" required>'
            + '<option value="0">Selecione a Divisão</option>'
            + '<option value="1">I</option>'
            + '<option value="2">II</option>'
            + '<option value="3">III</option>'
            + '<option value="4">IV</option>'
            + '</select>');
    }
}

//------------------------------------------------
function updateRank2v2Field() {
    var selectedRank = $('#maxRank').val();
    if (selectedRank == '1') { 
        $('#rankDivContainer').html('<input type="number" class="form-control bg-darker" id="maxRankMMR" name="maxRankMMR" placeholder="Insira o MMR" required>');
    } else {
        $('#rankDivContainer').html('<select class="form-control bg-darker" id="maxRankDiv" name="maxRankDiv" required>'
            + '<option value="0">Selecione a Divisão</option>'
            + '<option value="1">I</option>'
            + '<option value="2">II</option>'
            + '<option value="3">III</option>'
            + '<option value="4">IV</option>'
            + '</select>');
    }
}

//------------------------------------------------
// Recuperar os dados quando a página carregar
window.onload = function() {

    console.log('Página carregada, tentando carregar os dados do localStorage...');

    const storedData = JSON.parse(localStorage.getItem('formData'));
    if (storedData) {
        document.getElementById('player_name').value = storedData.player_name;
        document.getElementById('maxRank').value = storedData.maxRank;
        document.getElementById('max1v1Rank').value = storedData.max1v1Rank;
        document.getElementById('matches').value = storedData.matches;
        document.getElementById('goals').value = storedData.goals;
        document.getElementById('assists').value = storedData.assists;
        document.getElementById('saves').value = storedData.saves;
        document.getElementById('wins').value = storedData.wins;
        document.getElementById('mvps').value = storedData.mvps;
        document.getElementById('aerialGoals').value = storedData.aerialGoals;
        document.getElementById('longGoals').value = storedData.longGoals;
        document.getElementById('overtimeGoals').value = storedData.overtimeGoals;
        document.getElementById('epicSaves').value = storedData.epicSaves;
        document.getElementById('shots').value = storedData.shots;
        document.getElementById('centeredBalls').value = storedData.centeredBalls;
        document.getElementById('clearedBalls').value = storedData.clearedBalls;
        document.getElementById('aerialHits').value = storedData.aerialHits;
        document.getElementById('juggles').value = storedData.juggles;
        document.getElementById('demos').value = storedData.demos;

        updateRank1v1Field();
        updateRank2v2Field();

        try {
            document.getElementById('max1v1RankMMR').value = storedData.max1v1RankMMR;
        } catch (error) {}

        try {
            document.getElementById('max1v1RankDiv').value = storedData.max1v1RankDiv;
        } catch (error) {}

        try {
            document.getElementById('maxRankMMR').value = storedData.maxRankMMR;
        } catch (error) {}

        try {
            document.getElementById('maxRankDiv').value = storedData.maxRankDiv;
        } catch (error) {}
    }
};

//------------------------------------------------
$(document).ready(function() {

    $('#statsForm').submit(function(event) {
        event.preventDefault();
        saveData();
        sendData();
    });

    //------------------------------------------------
    $('#max1v1Rank').change(updateRank1v1Field);
    $('#maxRank').change(updateRank2v2Field);

    //------------------------------------------------
    function sendData() {
        $.ajax({
            url: $('#statsForm').attr('action'),
            method: 'POST',
            data: $('#statsForm').serialize(), 
            success: function(response) {
                $('#modalExemplo').modal('show');
                $("#div-modal-content").html(response);
            },
            error: function() {
                alert('Erro ao enviar o formulário');
            }
        });
    }

    //------------------------------------------------
    // Salvar os dados no LocalStorage
    function saveData(){

        console.log('Salvou os dados no LocalStorage');

        const dataForm = {
            player_name: document.getElementById('player_name') ? document.getElementById('player_name').value : '',
            maxRank: document.getElementById('maxRank') ? document.getElementById('maxRank').value : '',
            max1v1Rank: document.getElementById('max1v1Rank') ? document.getElementById('max1v1Rank').value : '',
            matches: document.getElementById('matches') ? document.getElementById('matches').value : '',
            goals: document.getElementById('goals') ? document.getElementById('goals').value : '',
            assists: document.getElementById('assists') ? document.getElementById('assists').value : '',
            saves: document.getElementById('saves') ? document.getElementById('saves').value : '',
            wins: document.getElementById('wins') ? document.getElementById('wins').value : '',
            mvps: document.getElementById('mvps') ? document.getElementById('mvps').value : '',
            aerialGoals: document.getElementById('aerialGoals') ? document.getElementById('aerialGoals').value : '',
            longGoals: document.getElementById('longGoals') ? document.getElementById('longGoals').value : '',
            overtimeGoals: document.getElementById('overtimeGoals') ? document.getElementById('overtimeGoals').value : '',
            epicSaves: document.getElementById('epicSaves') ? document.getElementById('epicSaves').value : '',
            shots: document.getElementById('shots') ? document.getElementById('shots').value : '',
            centeredBalls: document.getElementById('centeredBalls') ? document.getElementById('centeredBalls').value : '',
            clearedBalls: document.getElementById('clearedBalls') ? document.getElementById('clearedBalls').value : '',
            aerialHits: document.getElementById('aerialHits') ? document.getElementById('aerialHits').value : '',
            juggles: document.getElementById('juggles') ? document.getElementById('juggles').value : '',
            demos: document.getElementById('demos') ? document.getElementById('demos').value : '',
        };

        try {
                dataForm['max1v1RankDiv'] = document.getElementById('max1v1RankDiv').value;
        } catch (error) {}

        try {
                dataForm['max1v1RankMMR'] = document.getElementById('max1v1RankMMR').value;
        } catch (error) {}

        try {
                dataForm['maxRankDiv'] = document.getElementById('maxRankDiv').value;
        } catch (error) {}

        try {
                dataForm['maxRankMMR'] = document.getElementById('maxRankMMR').value;
        } catch (error) {}
            
        localStorage.setItem('formData', JSON.stringify(dataForm));
    }

});

//------------------------------------------------
function clearData() {
    if (confirm("Tem certeza que quer apagar seus dados?")) {
        localStorage.removeItem('formData');
        window.location.reload();
    }
}

//------------------------------------------------
function changeLang() {
    $('#langForm').submit();
}

</script>

<div class="language">
    <form id="langForm" method="get" action="index.php">
        <select class="lang-select form-select-sm float-right col-05" name="lang" id="lang" aria-label="" onchange="changeLang()">
            <option value="en-us" <?= isset($_GET['lang']) && $_GET['lang'] == "en-us" ? "active" : '' ?>> EN-US </option>
            <option value="pt-br" <?= isset($_GET['lang']) && $_GET['lang'] == "pt-br" ? "selected" : '' ?>> PT-BR </option>
        </select>
    </form>
</div>

<label class="label-select float-right col-05" for="lang-select">Linguagem</label>

<div class="container">
    <h2 class="page-header stats-form-header">Perfil > Carreira > Estatísticas de Carreira</h2>
</div>

<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Resumo da Carreira</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="div-modal-content">
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container form-container">
    <form id="statsForm" name="statsForm" method="post" action="index.php?module=home&action=calculate&lang=pt-br">

        <div class="form-row align-items-center">
            <div class="col-md-12">
                <label class="label-1" for="player_name">Nome do Jogador</label>
                <input type="text" class="form-control bg-darker" id="player_name" name="player_name" value="">
            </div>
            <div class="col-md-3">
                <label class="label-1" for="maxRank">Maior Rank em 2v2</label>
                <select class="form-control bg-darker" id="maxRank" name="maxRank" required>
                    <option value="0">Selecione o Rank</option>
                    <option value="152">Bronze I</option>
                    <option value="175">Bronze II</option>
                    <option value="237">Bronze III</option>
                    <option value="298">Prata I</option>
                    <option value="358">Prata II</option>
                    <option value="418">Prata III</option>
                    <option value="478">Ouro I</option>
                    <option value="538">Ouro II</option>
                    <option value="598">Ouro III</option>
                    <option value="658">Platina I</option>
                    <option value="718">Platina II</option>
                    <option value="778">Platina III</option>
                    <option value="843">Diamante I</option>
                    <option value="823">Diamante II</option>
                    <option value="1003">Diamante III</option>
                    <option value="1093">Campeão I</option>
                    <option value="1195">Campeão II</option>
                    <option value="1333">Campeão III</option>
                    <option value="1458">Supercampeão I</option>
                    <option value="1598">Supercampeão II</option>
                    <option value="1735">Supercampeão III</option>
                    <option value="1">Lenda Supersônica (Manual)</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="maxRankDiv">Divisão</label>
                <div id="rankDivContainer">
                    <select class="form-control bg-darker" id="maxRankDiv" name="maxRankDiv" required>
                        <option value="0">Selecione a Divisão</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="max1v1Rank">Maior Rank em 1v1</label>
                <select class="form-control bg-darker" id="max1v1Rank" name="max1v1Rank" required>
                    <option value="0">Selecione o Rank</option>
                    <option value="139">Bronze I</option>
                    <option value="158">Bronze II</option>
                    <option value="218">Bronze III</option>
                    <option value="278">Prata I</option>
                    <option value="338">Prata II</option>
                    <option value="398">Prata III</option>
                    <option value="458">Ouro I</option>
                    <option value="518">Ouro II</option>
                    <option value="578">Ouro III</option>
                    <option value="639">Platina I</option>
                    <option value="699">Platina II</option>
                    <option value="758">Platina III</option>
                    <option value="818">Diamante I</option>
                    <option value="878">Diamante II</option>
                    <option value="938">Diamante III</option>
                    <option value="998">Campeão I</option>
                    <option value="1058">Campeão II</option>
                    <option value="1118">Campeão III</option>
                    <option value="1178">Supercampeão I</option>
                    <option value="1238">Supercampeão II</option>
                    <option value="1299">Supercampeão III</option>
                    <option value="1">Lenda Supersônica (Manual)</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="max1v1RankDiv">Divisão</label>
                <div id="rank1v1DivContainer">
                    <select class="form-control bg-darker" id="max1v1RankDiv" name="max1v1RankDiv" required>
                        <option value="0">Selecione a Divisão</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="matches">Total de Partidas Jogadas</label>
                <input type="number" class="form-control bg-darker" id="matches" name="matches" min="0" value="10" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="goals">Gols</label>
                <input type="number" class="form-control bg-darker " id="goals" name="goals" min="0" value="30" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="assists">Assistências</label>
                <input type="number" class="form-control bg-darker " id="assists" name="assists" min="0" value="20" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="saves">Defesas</label>
                <input type="number" class="form-control bg-darker " id="saves" name="saves" min="0" value="20" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="wins">Vitórias</label>
                <input type="number" class="form-control bg-darker" id="wins" name="wins" min="0" value="6" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="mvps">MVPs</label>
                <input type="number" class="form-control bg-darker" id="mvps" name="mvps" min="0" value="4" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="aerialGoals">Gols Aéreos</label>
                <input type="number" class="form-control bg-darker" id="aerialGoals" name="aerialGoals" min="0" value="4" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="longGoals">Gols à Distância</label>
                <input type="number" class="form-control bg-darker" id="longGoals" name="longGoals" min="0" value="30" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="overtimeGoals">Gols em Prorrogação</label>
                <input type="number" class="form-control bg-darker" id="overtimeGoals" name="overtimeGoals" min="0" value="2" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="epicSaves">Defesas Épicas</label>
                <input type="number" class="form-control bg-darker" id="epicSaves" name="epicSaves" min="0" value="6" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="shots">Chutes ao Gol</label>
                <input type="number" class="form-control bg-darker" id="shots" name="shots" min="0" value="65" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="centeredBalls">Bolas ao Centro</label>
                <input type="number" class="form-control bg-darker" id="centeredBalls" name="centeredBalls" min="0" value="36" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="clearedBalls">Bolas Limpas</label>
                <input type="number" class="form-control bg-darker" id="clearedBalls" name="clearedBalls" min="0" value="34" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="aerialHits">Golpes Aéreos</label>
                <input type="number" class="form-control bg-darker" id="aerialHits" name="aerialHits" min="0" value="60" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="juggles">Malabarismos</label>
                <input type="number" class="form-control bg-darker" id="juggles" name="juggles" min="0" value="1" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="demos">Demolições</label>
                <input type="number" class="form-control bg-darker" id="demos" name="demos" min="0" value="18" required>
            </div>
        </div>
        <div class="form-row sbm-btn">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mr-1" value="Calculate">Calcular</button>
                <button type="button" class="btn btn-primary" value="Clear" onclick="clearData()">Limpar</button>
            </div>
        </div>
    </form>
</div>