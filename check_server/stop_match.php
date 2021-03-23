<?php
require("../dao/function.php");
$end_game=update_is_run_to_0("game");
$end_match_info=update_is_run_to_0("match_info");
if($end_time&&$end_match_info)
{
	    echo "your game is end!";
	        die();
}
else
{
	    echo "no";
	        die();
}


?>
