<?php
//Gest all the matches for a club
function getAllMatchesFromClub($club){
    $query = "SELECT g.id_games, w.name as wname, w.last as wlast, g.won_old, g.won_new,
					  l.name as lname, l.last as llast,  g.lost_old, g.lost_new, g.match_date
			 FROM games g JOIN players w ON w.id_player = g.fk_won JOIN players l ON l.id_player = g.fk_lost
			 WHERE w.fk_club=".escapeString($club)." OR l.fk_club=".escapeString($club)." ORDER BY g.match_date DESC";
    $resource = runQuery($query);
    return ozRunQuery($resource);
}

//Gest all the matches
function getAllMatches(){
    $query = "SELECT g.id_games, w.name as wname, w.last as wlast, g.won_old, g.won_new,
					  l.name as lname, l.last as llast,  g.lost_old, g.lost_new, g.match_date 
			 FROM games g JOIN players w ON w.id_player = g.fk_won JOIN players l ON l.id_player = g.fk_lost ORDER BY g.match_date DESC";
    $resource = runQuery($query);
    return ozRunQuery($resource);
}

//Gets the matches for an specific player
function getMatches($idplayer){
    $query = "SELECT * FROM aquigaza_fsutt_local.games 
                WHERE fk_won = ".escapeString($idplayer)." OR 
						fk_lost= ".escapeString($idplayer);
    $resource = runQuery($query);
    return ozRunQuery($resource);
}

//Adds a new match 
function addMatch($idWon, $idLost, $wonOldRat, $wonNewRat, $lostOldRat, $lostNewRat, $match_date){
    $query = "INSERT INTO aquigaza_fsutt_local.games 
		(`fk_won`, `fk_lost`, `won_old`, `won_new`, `lost_old`, `lost_new`, `match_date`)
		VALUES (".escapeString($idWon).",".escapeString($idLost).",".escapeString($wonOldRat).
			",".escapeString($wonNewRat).",".escapeString($lostOldRat).",".escapeString($lostNewRat).",'".escapeString($match_date)."')";
    $resource = runQuery($query);
}

//Gets the matches for an specific player
function deleteMatch($id_match){
    $query = "DELETE FROM aquigaza_fsutt_local.games WHERE id_games=".escapeString($id_match);
    $resource = runQuery($query);
}

?>
