<script type="text/javascript">

//------------------------------------------------
function updateRank1v1Field() {
    var selectedRank = $('#max1v1Rank').val();
    if (selectedRank == '1') { 
        $('#rank1v1DivContainer').html('<input type="number" class="form-control bg-darker" id="max1v1RankMMR" name="max1v1RankMMR" placeholder="Enter MMR" required>');
    } else {
        $('#rank1v1DivContainer').html('<select class="form-control bg-darker" id="max1v1RankDiv" name="max1v1RankDiv" required>'
            + '<option value="0">Select Division</option>'
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
        $('#rankDivContainer').html('<input type="number" class="form-control bg-darker" id="maxRankMMR" name="maxRankMMR" placeholder="Enter MMR" required>');
    } else {
        $('#rankDivContainer').html('<select class="form-control bg-darker" id="maxRankDiv" name="maxRankDiv" required>'
            + '<option value="0">Select Division</option>'
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
    if (confirm("Are you sure you want to clear your data?")) {
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
            <option value="pt-br" <?= isset($_GET['lang']) && $_GET['lang'] == "pt-br" ? "active" : '' ?>> PT-BR </option>
        </select>
    </form>
</div>

<label class="label-select float-right col-05" for="lang-select">Language</label>

<div class="container">
    <h2 class="page-header stats-form-header">Profile > Career > Stats</h2>
</div>

<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Career Stats</h3>
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
    <form id="statsForm" name="statsForm" method="post" action="index.php?module=home&action=calculate&lang=en-us">

        <div class="form-row align-items-center">
            <div class="col-md-12">
                <label class="label-1" for="player_name">Player Name</label>
                <input type="text" class="form-control bg-darker" id="player_name" name="player_name" value="">
            </div>
            <div class="col-md-3">
                <label class="label-1" for="maxRank">Your Highest Rank 2v2</label>
                <select class="form-control bg-darker" id="maxRank" name="maxRank" required>
                    <option value="0">Select Rank</option>
                    <option value="152">Bronze I</option>
                    <option value="175">Bronze II</option>
                    <option value="237">Bronze III</option>
                    <option value="298">Silver I</option>
                    <option value="358">Silver II</option>
                    <option value="418">Silver III</option>
                    <option value="478">Gold I</option>
                    <option value="538">Gold II</option>
                    <option value="598">Gold III</option>
                    <option value="658">Platinum I</option>
                    <option value="718">Platinum II</option>
                    <option value="778">Platinum III</option>
                    <option value="843">Diamond I</option>
                    <option value="823">Diamond II</option>
                    <option value="1003">Diamond III</option>
                    <option value="1093">Champion I</option>
                    <option value="1195">Champion II</option>
                    <option value="1333">Champion III</option>
                    <option value="1458">Grand Champion I</option>
                    <option value="1598">Grand Champion II</option>
                    <option value="1735">Grand Champion III</option>
                    <option value="1">SSL (Manual)</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="maxRankDiv">Division</label>
                <div id="rankDivContainer">
                    <select class="form-control bg-darker" id="maxRankDiv" name="maxRankDiv" required>
                        <option value="0">Select Division</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="max1v1Rank">Your Highest Rank 1v1</label>
                <select class="form-control bg-darker" id="max1v1Rank" name="max1v1Rank" required>
                    <option value="0">Select Rank</option>
                    <option value="139">Bronze I</option>
                    <option value="158">Bronze II</option>
                    <option value="218">Bronze III</option>
                    <option value="278">Silver I</option>
                    <option value="338">Silver II</option>
                    <option value="398">Silver III</option>
                    <option value="458">Gold I</option>
                    <option value="518">Gold II</option>
                    <option value="578">Gold III</option>
                    <option value="639">Platinum I</option>
                    <option value="699">Platinum II</option>
                    <option value="758">Platinum III</option>
                    <option value="818">Diamond I</option>
                    <option value="878">Diamond II</option>
                    <option value="938">Diamond III</option>
                    <option value="998">Champion I</option>
                    <option value="1058">Champion II</option>
                    <option value="1118">Champion III</option>
                    <option value="1178">Grand Champion I</option>
                    <option value="1238">Grand Champion II</option>
                    <option value="1299">Grand Champion III</option>
                    <option value="1">SSL (Manual)</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="max1v1RankDiv">Division</label>
                <div id="rank1v1DivContainer">
                    <select class="form-control bg-darker" id="max1v1RankDiv" name="max1v1RankDiv" required>
                        <option value="0">Select Division</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="matches">Total Matches Played</label>
                <input type="number" class="form-control bg-darker" id="matches" name="matches" min="0" value="10" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="goals">Goals</label>
                <input type="number" class="form-control bg-darker " id="goals" name="goals" min="0" value="30" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="assists">Assists</label>
                <input type="number" class="form-control bg-darker " id="assists" name="assists" min="0" value="20" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="saves">Saves</label>
                <input type="number" class="form-control bg-darker " id="saves" name="saves" min="0" value="20" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="wins">Wins</label>
                <input type="number" class="form-control bg-darker" id="wins" name="wins" min="0" value="6" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="mvps">MVPs</label>
                <input type="number" class="form-control bg-darker" id="mvps" name="mvps" min="0" value="4" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="aerialGoals">Aerial Goals</label>
                <input type="number" class="form-control bg-darker" id="aerialGoals" name="aerialGoals" min="0" value="4" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="longGoals">Long Goals</label>
                <input type="number" class="form-control bg-darker" id="longGoals" name="longGoals" min="0" value="30" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="overtimeGoals">Overtime Goals</label>
                <input type="number" class="form-control bg-darker" id="overtimeGoals" name="overtimeGoals" min="0" value="2" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="epicSaves">Epic Saves</label>
                <input type="number" class="form-control bg-darker" id="epicSaves" name="epicSaves" min="0" value="6" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="shots">Shots on Goal</label>
                <input type="number" class="form-control bg-darker" id="shots" name="shots" min="0" value="65" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="centeredBalls">Centered Balls</label>
                <input type="number" class="form-control bg-darker" id="centeredBalls" name="centeredBalls" min="0" value="36" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="clearedBalls">Cleared Balls</label>
                <input type="number" class="form-control bg-darker" id="clearedBalls" name="clearedBalls" min="0" value="34" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="aerialHits">Aerial Hits</label>
                <input type="number" class="form-control bg-darker" id="aerialHits" name="aerialHits" min="0" value="60" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="juggles">Juggles</label>
                <input type="number" class="form-control bg-darker" id="juggles" name="juggles" min="0" value="1" required>
            </div>
            <div class="col-md-3">
                <label class="label-1" for="demos">Demolitions</label>
                <input type="number" class="form-control bg-darker" id="demos" name="demos" min="0" value="18" required>
            </div>
        </div>
        <div class="form-row sbm-btn">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mr-1" value="Calculate">Calculate</button>
                <button type="button" class="btn btn-primary" value="Clear" onclick="clearData()">Clear</button>
            </div>
        </div>
    </form>
</div>