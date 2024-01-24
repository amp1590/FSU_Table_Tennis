<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__."/PHP/DBadmin.php");
require_once(__ROOT__."/PHP/CommonSQL.php");
include("ClubsSQL.php");

$action = $_REQUEST["action"]; //This variable should contain the selected dependency
$master = $_REQUEST["master"]; 

if($action == 'edit'){
	$id = $_REQUEST["id"]; //This variable should contain the selected dependency
	$editRow = $id; //It means we are not editing any row
}else{
	$editRow = -1; //It means we are not editing any row
}

if($action == 'add'){    
	$clubName = $_REQUEST["clubName"]; //This variable should contain the selected dependency
    addClub($con,$clubName);

	$result = "New club added successfully";
	echo($result);
}

if($action == 'remove'){    
	$id = $_REQUEST["id"]; //This variable should contain the selected dependency
    deleteClub($con,$id);

	$result = "Club removed successfully";
	echo($result);
}

if($action == 'update'){
	$name = $_REQUEST["Name"]; //This variable should contain the selected dependency
	$id = $_REQUEST["id"]; //This variable should contain the selected dependency
	updateClub($con,$id, $name);
}

$columns = array("id","Name");// Used to initialize fields for this table
$show_columns = array(1);// Indicates the column indexes that we want to display
$table = getClubs();//Obtains all the clubs

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

include($root_path."/PHP/GeneralTable.php");
?>