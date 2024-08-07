<?php
//Gets spacific row from rating difference
function getRatingFromDiff($diff){
    $query = "SELECT * FROM rating WHERE dif_from <= ".escapeString($diff)." AND dif_to >= ".escapeString($diff);
			   
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

//Gets rating able
function getRatings(){
    $query = "SELECT * FROM rating 
				ORDER BY dif_from ASC ";
    $resource = runQuery($query);
	return ozRunQuery($resource);
}

//Adds a new rating  
function addRating($difFrom, $difTo, $expected, $upset){
    $query = "INSERT INTO rating 
		(dif_from, dif_to, expected, upset)
		VALUES (".escapeString($difFrom).",".escapeString($difTo).",".escapeString($expected).",".escapeString($upset).")";
    $resource = runQuery($query);
}

//Deletes a rating range 
function deleteRating($idRat){
    $query = "DELETE FROM rating WHERE id_rating =".escapeString($idRat);
    $resource = runQuery($query);
}

function updateRatingsTable($id, $difFrom, $difTo, $expected, $upset){
    $query = "UPDATE rating SET dif_from='".escapeString($difFrom)."', 
        dif_to ='".escapeString($difTo)."',
        expected='".escapeString($expected)."',
        upset='".escapeString($upset)."' WHERE id_rating=".escapeString($id);

    $resource = runQuery($query);
}

?>
