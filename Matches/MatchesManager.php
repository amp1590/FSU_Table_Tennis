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

/* Algorithm for Rating calculation */
if($action == 'add'){   

	// Get the two players info who won and who lost
	$play_won = getPlayer($id_won);
	$play_lost = getPlayer($id_lost);

	/* ## Calculate the value "add_rat" to be added or subtrated from the rating of two players
	on the basis of the difference of players skill level according to USATT chart ## */

	$match_date = date("Y-m-d"); 
	$rating_date = $play_won[0][10];

	$winner_current_rating = $play_won[0][3]; 
	$loser_current_rating = $play_lost[0][3];

	if($match_date == $rating_date){ //If same date, then the initial rating of that date should be counted for difference calculation
		$winner_initial_rating = $play_won[0][9];
		$loser_initial_rating = $play_lost[0][9];
	}else{ //If different date, then the new rating of the previous date is the initial rating for difference calculation
		$winner_initial_rating = $play_won[0][3];
		$loser_initial_rating = $play_lost[0][3];
	}


	$dif_rating =  $winner_initial_rating - $loser_initial_rating; // Difference in initial rating of two players on the same day

	$rat_row = getRatingFromDiff(abs($dif_rating)); // Fetch the info of the difference from the "rating" table

	//Calculate how much to be added or subtracted from the rating according to expected or upset 

	if($dif_rating > 0){
		$add_rat = $rat_row[0][3]; //Expected
	}else{
		$add_rat = $rat_row[0][4]; //Upset
	}

	/* ## ## */

    /* $$ Add/Subtract the value "add_rat" to the current rating of the respective players $$ */ 
	$winner_current_rating = $winner_current_rating + $add_rat;
	$loser_current_rating = $loser_current_rating - $add_rat;

	/* $$ $$ */

	addMatch($id_won , $id_lost, $winner_initial_rating, $winner_current_rating, $loser_initial_rating, $loser_current_rating, $match_date);

	//Updating players ratings
	updateRating($id_won, $winner_current_rating, $winner_initial_rating, $match_date);
	updateRating($id_lost, $loser_current_rating, $loser_initial_rating, $match_date);


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
