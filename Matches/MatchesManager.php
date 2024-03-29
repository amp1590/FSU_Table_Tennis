<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__."/PHP/DBadmin.php");
require_once(__ROOT__."/PHP/CommonSQL.php");
require_once(__ROOT__."/Players/PlayersSQL.php");
require_once(__ROOT__."/Clubs/ClubsSQL.php");
require_once(__ROOT__."/Rating_table/RatSQL.php");
require_once("MatchesSQL.php");

$action = $_REQUEST["action"]; 
$sel_club = $_REQUEST["sel_club"]; 
$master = $_REQUEST["master"]; 

if($action == 'edit'){
	$id = $_REQUEST["id"]; 
	$editRow = $id; 
}else{
	$editRow = -1; 
}

if( ($action == 'add') || ($action == 'update') ){
	$id_won = $_REQUEST["id_won"]; 
	$id_lost = $_REQUEST["id_lost"];
}

//Algorithm for Rating calculation
if($action == 'add'){    

	$play_won = getPlayer($id_won);
	$play_lost = getPlayer($id_lost);

	// Difference in rating
	$dif_rating =  $play_won[0][3] - $play_lost[0][3];

	$rat_row = getRatingFromDiff(abs($dif_rating));

	if($dif_rating > 0){//Expected
		$add_rat = $rat_row[0][3];
	}else{
		$add_rat = $rat_row[0][4];
	}

	$winner_rating = $play_won[0][3];
	$loser_rating = $play_lost[0][3];
	$new_won = $winner_rating + $add_rat;
	$new_lost = $loser_rating - $add_rat;
	$date = date("Y-m-d");

	addMatch($id_won , $id_lost, $winner_rating, $new_won, $loser_rating, $new_lost, $date);

	//Updating players ratings
	updateRating($id_won, $new_won);
	updateRating($id_lost, $new_lost);


	$result = "New match added successfully <br>";
	echo($result);
}

if($action == 'remove'){    
	$id = $_REQUEST["id"]; 
    deleteMatch($id);

	$result = "Match removed successfully (warning no rating update)<br>";
	echo($result);
}

if($action == 'update'){
	$idPlayer= $_REQUEST["id_play"]; 
	updatePlayer($idPlayer, $name, $last, $rating, $usatt, $id_club, null);
}

$clubs = getClubs(); //Obtains all the clubs

//---------- Configure the Players table
if(empty($sel_club)){
	$playersWin  = getAllPlayersOrderBy('name');
	$playersLos =  $playersWin;
} else {
	$playersWin  = getAllPlayersOrderBy('name');
	$playersLos = getAllPlayersOrderBy('name');
}
	
$allowEdit = false;
$allowDelete = false;

if(!isset($sel_club)){
	$matches = getAllMatches();
} else {
	$matches = getAllMatchesFromClub($sel_club);
}

//To provide the admin access for Matches page
if($master == "yoda"){
	$allowEdit = true;
	$allowDelete = true;
	$allowAdd = true;
}elseif($master == "vader"){
	$allowEdit = true;
	$allowDelete = false;
	$allowAdd = false;
}else{
	$master = "none";
	$allowEdit = false;
	$allowDelete = false;
	$allowAdd = false;
}
	

include("MatchesTable.php"); 

?>
