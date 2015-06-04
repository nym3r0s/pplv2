<?php
require './../includes/dbconfig.php';

$query = "SELECT * FROM displayBatting WHERE 1";
$query_res = mysqli_query($link,$query);

for($i = 0,$score = 0; $i < mysqli_num_rows($query_res); $i++, $score=0){

        $run = 
mysql_result($query_res,$i,"runs");
        $score = $run;

        $score = $score + intval($score/25)*15;                 //Bonus for milestones

        $four = 
mysql_result($query_res,$i,"four");                //Bonus for fours
        $score = $score + $four;

        $six = 
mysql_result($query_res,$i,"six");                //Bonus for sixers
        $score = $score + $six;

        $runRate = 
mysql_result($query_res,$i,"strikeRate");    //Bonus for strike rate
        if($runRate < 70 && $run >= 20)
            $score= $score - 10;
        else if($runRate < 90 && $run >= 20);
        else if($runRate < 120 && $run >= 20)
            $score = $score + 10;
        else if($runRate < 150 && $run >= 20)
            $score = $score + 20;
        else if($runRate <= 180 && $run >= 20)
            $score = $score + 30;
        else if($runRate > 180 && $run >=20)
            $score = $score + 50;

        $name = 
mysql_result($query_res,$i,"playerName");

        $count_name = mysqli_query($link,"SELECT `playerId` FROM `players` WHERE name = '".$name."'");
        $count_secondName = mysqli_query($link,"SELECT `playerId` FROM `players` WHERE secondName = '".$name."'");

        if(mysqli_num_rows($count_name))
            $playerId = 
mysql_result($count_name,0,"playerId");
        else if(mysqli_num_rows($count_secondName))
            $playerId = 
mysql_result($count_secondName,0,"playerId");
        else{
            $querySel = "SELECT * FROM players WHERE 1";
            $res = mysqli_query($link,$querySel);

            for($k = 0; $k < mysqli_num_rows($res); $k++)
                $player[$k] = 
mysql_result($res,$k,"name");

            $sum = 0;

            $player_i = explode(" ",$name);
            $pos_i = substr_count($name,' ');

            for($j = 0; $j < mysqli_num_rows($res); $j++){

                $player_j = explode(" ",$player[$j]);
                $pos_j = substr_count($player[$j],' ');

                if($player_i[$pos_i] == $player_j[$pos_j])
                    $playerId = 
mysql_result($res,$j,"playerId");
                }
        }

        echo $playerId." ";

        $type_query = mysqli_query($link,"SELECT `type` FROM `players` WHERE playerId = '".$playerId."'");

        $duck = 
mysql_result($query_res,$i,"wicketInfo");
        if($run == 0 && $duck != "" && 
mysql_result($type_query,0,"type") != "Batsman")                            //Minus for ducks
            $score = -5;
        else if($run == 0 && $duck != "")
            $score = -10;

        mysqli_query($link,"UPDATE `players` SET roundOne = '".$score."' WHERE playerId = '".$playerId."'");
        }
?>
