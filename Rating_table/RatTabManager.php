<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__."/PHP/DBadmin.php");
require_once(__ROOT__."/PHP/CommonSQL.php");
require_once("RatSQL.php");

$action = $_REQUEST["action"]; 

if($action == 'edit'){
	$id = $_REQUEST["id"]; 
	$editRow = $id; 
}else{
	$editRow = -1; 
}

if( ($action == 'add') || ($action == 'update') ){
	$low = $_REQUEST["low"]; 
	$high = $_REQUEST["high"];
	$exp = $_REQUEST["exp"];
	$upset = $_REQUEST["upset"];
}

if($action == 'add'){    
	addRating($low, $high, $exp, $upset);
	$result = "New range added successfully";
	echo($result);
}

if($action == 'remove'){    
	$id = $_REQUEST["id"]; 
    deleteRating($id);

	$result = "Range removed successfully";
	echo($result);
}

if($action == 'update'){
	$id = $_REQUEST["id"]; 
	updateRating($id, $low, $high, $exp, $upset);
}

//---------- Configure the Clubs table
$columns = array("id","From","To","Expected","Upset");// Used to initialize fields for this table
$show_columns = array(1,2,3,4);// Indicates the column indexes that we want to display
$table = getRatings();//Obtains all the clubs

$allowEdit = false;
$allowDelete = false;
include(__ROOT__."/PHP/GeneralTable.php");
	
?>
