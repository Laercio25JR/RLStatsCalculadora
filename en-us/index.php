<?php 
session_start();

$module = isset($_GET["module"]) ? $_GET["module"] : "home";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";

// AUTOLOAD  -------------------------------------------------------
include_once("autoload.php");

use \Controller\LangController;

// ROTEADOR --------------------------------------------------------
if (strtolower($module) == 'home') {
    $ctrl = new LangController();

    switch( strtolower($action) )  {
        case "calculate" :

            $Lang = "en-us";
            $Matches = isset($_POST["matches"])? $_POST["matches"] : 1;
            $Goals = isset($_POST["goals"])? $_POST["goals"] : 1;
            $Assists = isset($_POST["assists"])? $_POST["assists"] : 1;
            $Saves = isset($_POST["saves"])? $_POST["saves"] : 1;
            $Wins = isset($_POST["wins"])? $_POST["wins"] : 1;
            $MVPs = isset($_POST["mvps"])? $_POST["mvps"] : 1;
            $AerialGoals = isset($_POST["aerialGoals"])? $_POST["aerialGoals"] : 1;
            $LongGoals = isset($_POST["longGoals"])? $_POST["longGoals"] : 1;
            $OvertimeGoals = isset($_POST["overtimeGoals"])? $_POST["overtimeGoals"] : 1;
            $EpicSaves = isset($_POST["epicSaves"])? $_POST["epicSaves"] : 1;
            $Shots = isset($_POST["shots"])? $_POST["shots"] : 1;
            $CenteredBalls = isset($_POST["centeredBalls"])? $_POST["centeredBalls"] : 1;
            $ClearedBalls = isset($_POST["clearedBalls"])? $_POST["clearedBalls"] : 1;
            $AerialHits = isset($_POST["aerialHits"])? $_POST["aerialHits"] : 1;
            $Juggles = isset($_POST["juggles"])? $_POST["juggles"] : 1;
            $Demos = isset($_POST["demos"])? $_POST["demos"] : 1;
            $Max2v2Rank = isset($_POST["maxRank"])? $_POST["maxRank"] : 1;
            $Max2v2RankDiv = isset($_POST["maxRankDiv"])? $_POST["maxRankDiv"] : 1;
            $Max1v1Rank = isset($_POST["max1v1Rank"])? $_POST["max1v1Rank"] : 1;
            $Max1v1RankDiv = isset($_POST["max1v1RankDiv"])? $_POST["max1v1RankDiv"] : 1;
            $PlayerName = isset($_POST["player_name"])? $_POST["player_name"] : '';
            $SSL_MMR = isset($_POST["maxRankMMR"])? $_POST["maxRankMMR"] : 0;
            $SSL_1v1_MMR = isset($_POST["max1v1RankMMR"]) ? $_POST["max1v1RankMMR"] : 0;

            $ctrl->Get_Main_Controller($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $PlayerName, $SSL_MMR, $SSL_1v1_MMR);
            break;

        default:
            $ctrl->Defaut();
            break;
    }
}

else {

	$ctrl = new LangController();
	$ctrl->Defaut();

}