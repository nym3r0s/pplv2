<?php
require './../includes/dbconfig.php';

$query = "SELECT * FROM displayBowling WHERE 1";
$query_res = mysqli_query($link,$query);

for($i = 0,$score = 0; $i < mysqli_num_rows($query_res); $i++, $score=0){

        $wickets = 
mysql_result($query_res,$i,"wickets");
        $score = $wickets * 20;

        $score = $score + intval($wickets)*15 - 15;             //Bonus for milestones


        $maidens = 
mysql_result($query_res,$i,"maidens");                //Bonus for maidens
        $score = $score + $maidens;

        $economy = 
mysql_result($query_res,$i,"economy");    //Bonus for strike rate
        if($economy < 3)
            $score= $score + 40;
        else if($economy < 4.5)
            $score= $score + 30;
        else if($economy < 6)
            $score= $score + 20;
        else if($economy < 8);
        else
            $score = $score - 10;

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
        $init_score = 
mysql_result(mysqli_query($link,"SELECT `roundOne` FROM `players` WHERE playerId = '".$playerId."'"),0,"roundOne");

        $score = $score + $init_score;
        mysqli_query($link,"UPDATE `players` SET roundOne = '".$score."' WHERE playerId = '".$playerId."'");
        }
?>
