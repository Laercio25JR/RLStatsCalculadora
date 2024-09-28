<?php 

namespace Controller;

require_once "../Controller/FormController.php";

use \Controller\FormController;

class LangController {

    // ----------------------------------------------------------------
    public function Defaut() 
    {
        $arquivo = "View/FormView.php";
        include_once "View/indexView.php";
    }

    // ----------------------------------------------------------------
   public function Get_Main_Controller($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $PlayerName, $SSL_MMR, $SSL_1v1_MMR) {
        
    $main_controller = new FormController();

        $main_controller->GetStats($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $PlayerName, $SSL_MMR, $SSL_1v1_MMR);
   }

}