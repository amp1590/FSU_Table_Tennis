<?php

/**
 *Default function that saves the results of a query into an array
 * @param type $resource
 * @return null 
 */
function ozRunQuery($resource){
    if($resource){
        $rows = getRowsFromResource($resource);
        return $rows;
    }
    return null;
}

?>
