<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__."/PHP/DBadmin.php");
require_once(__ROOT__."/PHP/CommonSQL.php");
require_once(__ROOT__."/Clubs/ClubsSQL.php");
require_once(__ROOT__."/Players/PlayersSQL.php");

$action = $_REQUEST["action"]; 
function updateIsTraining($idPlayer, $isTraining){
    $query = "UPDATE aquigaza_fsutt_local.players SET
		training='".escapeString($isTraining)."'";

	$query = $query." WHERE id_player=".escapeString($idPlayer);
    $resource = runQuery($query);
}
function clearTraining(){
    $query = "UPDATE aquigaza_fsutt_local.players SET
		training='0'";
    $resource = runQuery($query);
}

if( ($action === 'add') ){
	$id= $_REQUEST["id"]; 
	updateIsTraining($id,1);
	$result = "New player added successfully";
	echo($result);
}

if($action === 'delete'){    
	$id = $_REQUEST["id"]; 
    updateIsTraining($id,0);
	$result = "Player removed successfully";
	echo($result);
}

if($action === 'clear'){    
    clearTraining();
	$result = "Cleared training";
	echo($result);
}


//---------- Configure the Training table
$players = getAllPlayers();
$training_players = getTrainingPlayers(1);

include("PlayersTable.php"); 

?>
