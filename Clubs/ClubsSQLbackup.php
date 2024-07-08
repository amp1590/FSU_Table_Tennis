<?php
//Gets the last updates from all the packages and versions
function getClubs(){
    $query = "SELECT * FROM $database.clubs" ;
    $resource = runQuery($query);
	return ozRunQuery($resource);

}

//Gets one club by id
function getClub($id){
    $query = "SELECT * FROM $database.clubs WHERE id_club=".escapeString($id);
    $resource = runQuery($query);
	return ozRunQuery($resource);

}
//Adds a new club 
function addClub($con,$name){
    $query = "INSERT INTO $database.clubs (name) VALUES ('".escapeString($name)."')";
    $resource = runQuery($query);
}

function updateClub($con,$idClub, $name){
    $query = "UPDATE $database.clubs SET
        name='".escapeString($name)."' 
        WHERE id_club=".escapeString($idClub)."";
    $resource = runQuery($query);
}

//Deletes one club
function deleteClub($con,$idclub){
    $query = "DELETE FROM $database.clubs WHERE id_club= ".escapeString($idclub);
	$resource = runQuery($query);
}

?>
