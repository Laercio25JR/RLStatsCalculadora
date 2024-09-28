<?php 

namespace Controller;


class FormController {

    // ----------------------------------------------------------------
    public function Defaut() 
    {
        $arquivo = "View/FormView.php";
        include_once "View/indexView.php";
    }

    // ----------------------------------------------------------------
    public function calculateStats($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $Max2v2Rank, $Max1v1Rank) {

        $Ratio_Max2v2Rank = ($Max2v2Rank / 2700) * 5;
        $Ratio_Max1v1Rank = ($Max1v1Rank / 1870) * 5;

        $Add_Stats = 0;
        $Add_Decisive = -4.5;

        $Ampl_Stats = 1.5;
        $Ampl_Rank = 0.1;
        $Ampl_MVP = 10;
        $Ampl_Drible = 1;
        $Ampl_Goals = 3;  
        $Ampl_Jugg = 15;
        $Ampl_Aer_Goals = 2;
        $Ampl_Pre = 0.9;
        $Ampl_Overtime_Goal = 10;
        $Ampl_Shots = 0.6;
        $Ampl_Assists = 1;
        $Ampl_Aer_Hits = 0.5;

        $Div_Cent_Ball = 2.3;

        $Scaling_Def = 1.5;
        $Scaling_Drible = 1;
        $Scaling_Press = 0.6;
        $Scaling_Assist = 1.25;
        $Scaling_Aer_Hits = 0.8;
        $Scaling_Shots = 1.1;
        
        //---------------------------------------------------------------
        $Ratio_Goals = $Goals / $Matches;
        $Ratio_Assists = $Assists / ($Matches / $Scaling_Assist);
        $Ratio_Saves = $Saves / ($Matches / $Scaling_Def);
        $Ratio_MVPs = $MVPs / $Matches;
        $Ratio_AerialGoals = $AerialGoals / $Matches;
        $Ratio_LongGoals = $LongGoals / $Matches;
        $Ratio_OvertimeGoals = $OvertimeGoals / $Matches;
        $Ratio_EpicSaves = $EpicSaves / ($Matches / $Scaling_Def);
        $Ratio_Shots = $Shots / (($Matches / $Scaling_Press) / $Scaling_Shots);
        $Ratio_CenteredBalls = $CenteredBalls / ($Matches / $Scaling_Press);
        $Ratio_ClearedBalls = $ClearedBalls / ($Matches / $Scaling_Press);
        $Ratio_AerialHits = $AerialHits / (($Matches / $Scaling_Aer_Hits) / $Scaling_Press);
        $Ratio_Juggles = $Juggles / ($Matches / $Scaling_Drible);
        $Ratio_Demos = $Demos / $Matches;

        //---------------------------------------------------------------
        // RBR = RankBasedRatio

        $RBR_Goals = $Ratio_Goals * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank * $Ampl_Goals);
        $RBR_Shots = (($Ratio_Shots * $Ratio_Max2v2Rank) + ($Ratio_Max2v2Rank * $Ampl_Rank)) / 2;
        $RBR_AerialGoals = $Ratio_AerialGoals * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank) * $Ampl_Aer_Goals;
        $RBR_LongGoals = $Ratio_LongGoals * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank);
        $RBR_Assists = $Ratio_Assists * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank * $Ampl_Assists);
        $RBR_CenteredBalls = ($Ratio_CenteredBalls * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank)) / $Div_Cent_Ball;
        $RBR_Demos = $Ratio_Demos * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank);
        $RBR_AerialHits = (($Ratio_AerialHits * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank)) / 2) * $Ampl_Aer_Goals;
        $RBR_Saves = $Ratio_Saves * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank);
        $RBR_ClearedBalls = ($Ratio_ClearedBalls * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank)) / 2;
        $RBR_EpicSaves = $Ratio_EpicSaves * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank);
        $RBR_MVPs = $Ratio_MVPs * ($Ratio_Max2v2Rank * $Ampl_MVP) + ($Ratio_Max2v2Rank * ($Ampl_Rank - 1));
        $RBR_OvertimeGoals = $Ratio_OvertimeGoals * $Ratio_Max2v2Rank + ($Ratio_Max2v2Rank * $Ampl_Rank) * $Ampl_MVP;
        $RBR_Juggles = ($Ratio_Juggles * $Ampl_Jugg) * $Ratio_Max1v1Rank + ($Ratio_Max1v1Rank * $Ampl_Rank * $Ampl_Drible);

        //---------------------------------------------------------------
        $Shots_OVR = ((($RBR_Goals + $RBR_Shots) / 2) * 10 * $Ampl_Stats + $Add_Stats + $RBR_AerialGoals + $RBR_LongGoals) * $Ampl_Shots;
        $Pass_OVR = (($RBR_Assists + $RBR_CenteredBalls) / 2) * 10 * $Ampl_Stats + $Add_Stats;
        $Pression_OVR = (($RBR_Shots + $RBR_CenteredBalls + $RBR_Demos + $RBR_AerialHits) / 4) * 10 * $Ampl_Stats * $Ampl_Pre + $Add_Stats;
        $Defense_OVR = (($RBR_Saves + $RBR_EpicSaves + $RBR_ClearedBalls) / 3) * 10 * $Ampl_Stats + $Add_Stats;
        $Drible_OVR = (($RBR_Juggles + $RBR_Juggles + $RBR_Goals) / 3) * 10 * $Ampl_Stats + $Add_Stats;
        $Aerial_OVR = (($RBR_AerialGoals + $RBR_AerialHits) / 2) * 10 * $Ampl_Stats + $Add_Stats;
        $Decisive_OVR = (($RBR_MVPs + $RBR_OvertimeGoals) / 2) * 10 * $Ampl_Stats + $Add_Stats + $Add_Decisive;
        $Precision_OVR = (($Ratio_Goals / $Ratio_Shots) + ($Ratio_Assists / $Ratio_CenteredBalls)) / 2;

        $Total_OVR = (($Shots_OVR + $Pass_OVR + $Pression_OVR + $Defense_OVR + $Drible_OVR + $Aerial_OVR + $Decisive_OVR) / 6.5);

        //---------------------------------------------------------------
        
        $Passer_Arq_Val = $Pass_OVR - ($Shots_OVR / 2);
        $Agressive_Arq_Val = $Pression_OVR - ($Defense_OVR / 2);
        $Ancor_Arq_Val = ($Defense_OVR) - ($Drible_OVR / 2);
        $Solo_Arq_Val = (($Shots_OVR * 0.2 + (($Aerial_OVR > $Drible_OVR) ? $Aerial_OVR * 0.5 : $Drible_OVR * 0.5) + ($Decisive_OVR * 0.3))) - ($Pass_OVR / 2);

        $Arq_Sum = $Passer_Arq_Val + $Agressive_Arq_Val + $Ancor_Arq_Val + $Solo_Arq_Val;
        $Arq_Passer_Perc = ($Passer_Arq_Val / $Arq_Sum) * 100;
        $Arq_Agressive_Perc = ($Agressive_Arq_Val / $Arq_Sum) * 100;
        $Arq_Ancor_Perc = ($Ancor_Arq_Val / $Arq_Sum) * 100;
        $Arq_Solo_Perc = ($Solo_Arq_Val / $Arq_Sum) * 100;

        //---------------------------------------------------------------
        switch ($Lang) {
            case 'en-us':
                $Arq_Array = array (
                    'Passer' => $Arq_Passer_Perc, 
                    'Agressive' => $Arq_Agressive_Perc, 
                    'Ancor' => $Arq_Ancor_Perc, 
                    'Solo' => $Arq_Solo_Perc
                );
                break;

            case 'pt-br':
                $Arq_Array = array (
                    'Passador' => $Arq_Passer_Perc, 
                    'Agressivo' => $Arq_Agressive_Perc, 
                    'Âncora' => $Arq_Ancor_Perc, 
                    'Solo' => $Arq_Solo_Perc
                );
        }

        //---------------------------------------------------------------
        arsort($Arq_Array);

        $Arq_Keys = array_keys($Arq_Array);
        
        $Arquetype1_Key = $Arq_Keys[0];
        $Arquetype2_Key = $Arq_Keys[1];
        $Arquetype3_Key = $Arq_Keys[2];
        $Arquetype4_Key = $Arq_Keys[3];
        
        $Arquetype1_Perc = $Arq_Array[$Arquetype1_Key];
        $Arquetype2_Perc = $Arq_Array[$Arquetype2_Key];
        $Arquetype3_Perc = $Arq_Array[$Arquetype3_Key];
        $Arquetype4_Perc = $Arq_Array[$Arquetype4_Key];

        //---------------------------------------------------------------

        $Avg_Arq = 25;

        $Dif_Arq = 0;

        $Balanced = false;
        
        foreach ($Arq_Array as $Arq_Perc){
            $Dif_Arq += abs(number_format($Arq_Perc, 2) - $Avg_Arq);
        }

        if ($Dif_Arq < 5) $Balanced = true;

        return array ($Total_OVR, $Shots_OVR, $Pass_OVR, $Pression_OVR, $Defense_OVR, $Drible_OVR, $Aerial_OVR, $Decisive_OVR, $Precision_OVR, $Arquetype1_Key, $Arquetype1_Perc, $Arquetype2_Key, $Arquetype2_Perc, $Arquetype3_Key, $Arquetype3_Perc, $Arquetype4_Key, $Arquetype4_Perc, $Balanced);
    }

    // ----------------------------------------------------------------
    public function CalculateMMR($Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $SSL_MMR, $SSL_1v1_MMR)
    {
        switch ($Max2v2RankDiv) {
            case '1':
                break;

            case '2':
                $Max2v2Rank = $Max2v2Rank * 1.025;
                break;

            case '3':
                $Max2v2Rank = $Max2v2Rank * 1.05;
                break;

            case '4':
                $Max2v2Rank = $Max2v2Rank * 1.075;
                break;
            
            default:
                break;
        }

        switch ($Max1v1RankDiv) {
            case '1':
                break;

            case '2':
                $Max1v1Rank = $Max1v1Rank + 15;
                break;
            
            case '3':
                $Max1v1Rank = $Max1v1Rank + 31;
                break;
            
            case '4':
                $Max1v1Rank = $Max1v1Rank + 47;
                break;

            default:
                break;
        }

        if ($SSL_MMR != 0) {
            $Max2v2Rank = $SSL_MMR;
        }

        if ($SSL_1v1_MMR != 0) {
            $Max1v1Rank = $SSL_1v1_MMR;
        }
        
        return array($Max2v2Rank, $Max1v1Rank);
    }
        
    // ----------------------------------------------------------------
    public function GetStats($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $PlayerName, $SSL_MMR, $SSL_1v1_MMR) 
    {
        if (isset($OVR_Stats)) {$this->ShowResult($OVR_Stats, $PlayerName);}
        else 
        {
            $MaxRanks = $this->CalculateMMR($Max2v2Rank, $Max2v2RankDiv, $Max1v1Rank, $Max1v1RankDiv, $SSL_MMR, $SSL_1v1_MMR);

            $OVR_Stats = $this->calculateStats($Lang, $Matches, $Goals, $Assists, $Saves, $Wins, $MVPs, $AerialGoals, $LongGoals, $OvertimeGoals, $EpicSaves, $Shots, $CenteredBalls, $ClearedBalls, $AerialHits, $Juggles, $Demos, $MaxRanks[0], $MaxRanks[1]);

            $this->ShowResult($OVR_Stats, $PlayerName);
        }
    }

    // ----------------------------------------------------------------
    public function ShowResult($OVR_Stats, $PlayerName) 
    {
        $PlayStyle = ($OVR_Stats[17] == true)? "Balanced" : $OVR_Stats[9]; 

        if ($OVR_Stats[12] >= 28){
            $PlayStyle = $OVR_Stats[9].'/'.$OVR_Stats[11];
        }

    $arquivo = "View/CardView.php";
    include_once "View/indexView.php"; 
    }
}