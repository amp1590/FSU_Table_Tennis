<?php
/*
 * Gets all the players
 */
function getAllPlayers(){
	$query = "SELECT * FROM $database.players ORDER by rating DESC";
    $resource = runQuery($query);
	return ozRunQuery($resource);
}
/*
 * Gets all the players that are training today
 */
function getTrainingPlayers($training){
	$query = "SELECT name FROM $database.players "
			. "WHERE training = ".$training." ORDER by rating DESC";
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

/*
 * Gets all the players order by an specific field
 */
function getAllPlayersOrderBy($field){
	$query = "SELECT * FROM $database.players ORDER by ".$field;
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

function getRatingHistory($id){
	$query = "SELECT * FROM $database.games WHERE ".
					" fk_won = ".$id." OR fk_lost = ".$id." ORDER BY match_date";
    $resource = runQuery($query);
	return ozRunQuery($resource);
}


/*
 * Gets specific player
 */
function getPlayer($idplay){
	$query = "SELECT * FROM $database.players WHERE id_player=".escapeString($idplay);
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

/*
 * Gets the players from specific group
 */
function getPlayersFromClub($idclub){
	$query = "SELECT * FROM $database.players WHERE fk_club=".escapeString($idclub)." ORDER by rating DESC";
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

//Adds a new player 
function addPlayer($name, $last, $rating, $usatt, $idclub, $date, $email){
    $query = "INSERT INTO $database.players
	(`name`, `last`, `rating`, `usatt_rat`, `fk_club`, `startdate`, `email`)
	VALUES	('".escapeString($name)."','".escapeString($last)."','".escapeString($rating)."',".escapeString($usatt).
			",".escapeString($idclub).",'".escapeString($date)."','".escapeString($email)."')";
    $resource = runQuery($query);
}

function updatePlayer($idPlayer, $name, $last, $rating, $usatt, $club, $start,$email){
    $query = "UPDATE $database.players SET
        name='".escapeString($name)."', 
        last='".escapeString($last)."',
        rating='".escapeString($rating)."',
        usatt_rat='".escapeString($usatt)."',
		email='".escapeString($email)."'";

	if($start != null){
        $query = $query.", startdate='".escapeString($start)."' ";
	}

	$query = $query.", fk_club=".escapeString($club)." WHERE id_player=".escapeString($idPlayer);

    $resource = runQuery($query);
}

function updateRating($id_play, $new_rat){
    $query = "UPDATE $database.players SET
        rating='".escapeString($new_rat)."' WHERE id_player=".escapeString($id_play);

    $resource = runQuery($query);

}

//Deletes a player
function deletePlayer($idPlayer){
    $query = "DELETE FROM $database.players WHERE id_player=".escapeString($idPlayer);
    $resource = runQuery($query);
}
?>
