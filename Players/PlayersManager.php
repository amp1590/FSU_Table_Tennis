<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__."/PHP/DBadmin.php");
require_once(__ROOT__."/PHP/CommonSQL.php");
require_once(__ROOT__."/Clubs/ClubsSQL.php");
require_once("PlayersSQL.php");

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
	$name = $_REQUEST["name"]; 
	$last = $_REQUEST["last_name"];
	$rating = $_REQUEST["club_rat"];
	$usatt = $_REQUEST["usatt_rat"];
	$id_club = $_REQUEST["id_club"]; 
	$email= $_REQUEST["email"]; 
	$date = date("Y-m-d");
}

if($action == 'add'){    
	addPlayer($name, $last, $rating, $usatt, $id_club, $date,$email);
	$result = "New player added successfully";
	echo($result);
}

if($action == 'remove'){    
	$id = $_REQUEST["id"]; 
    deletePlayer($id);

	$result = "Player removed successfully";
	echo($result);
}

if($action == 'update'){
	$idPlayer= $_REQUEST["id_play"]; 
	updatePlayer($idPlayer, $name, $last, $rating, $usatt, $id_club, null,$email);
}

//---------- Configure the Clubs table
$columns = array("id","Name");// Used to initialize fields for this table
$show_columns = array(1);// Indicates the column indexes that we want to display
$clubs= getClubs();//Obtains all the clubs
include("ClubsTable.php"); 

//---------- Configure the Players table
if(empty($sel_club)){
	$players = getAllPlayers();
}else{
	$players = getPlayersFromClub($sel_club);
}

if($master == "yoda"){
	$allowEdit = true;
	$allowDelete = true;
}elseif($master == "vader"){
	$allowEdit = true;
	$allowDelete = false;
}else{
	$master = "none";
	$allowEdit = false;
	$allowDelete = false;
}
	

include("PlayersTable.php"); 

?>
