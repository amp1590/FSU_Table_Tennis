<?php
//This file is used to connect to the database

ini_set('display_errors', 1);
error_reporting(E_ERROR|E_WARNING);

//make sure we can connect to the db
if (!connectDB())
    die("couldn't connect to the DB");

// Runs the specified query, returns the results on ok, false on error
function runQuery($query)
{        
    //connect (if there is a previous connection it will be reused)
    if(!connectDB())
        return false;

    $result=mysqli_query($query);
    if(!$result)
    {
        $s=mysqli_error($con);
        echo("Could not run query ${query}: ${s}<br>");
        return false;
    }

    //Don't explicitly close the connection when exiting this function.
    //or else all the calls to mysqli_real_escape_string will fail
    //the connection is reused automatically anyways and will automatically
    //be closed when the script ends.

    return $result;
}

//Gets the names of the fields in the query result and puts them in an array
function mysqli_field_names( $result )
{   

    $numfields = mysqli_num_fields( $result );//Gets the number of fields in the query result

    for ( $i = 0; $i < $numfields; $i++ )//Stores the names of the fields in the array $names
        $names[] = mysqli_field_name( $result, $i );

    return $names;
}

//Gets all the rows of a query from a resource
function getRowsFromResource($resource){
    $i = 0;
    while($row = mysqli_fetch_row($resource)){
        $rows[$i] = $row;//Adds this row to the main array
        $i++;
    }
    return $rows;
}

// Connects to a database
function connectDB()
{

    $user = "aquigaza_fsuttra";
    $pw = "4Y=.aP8JZgdd78=S";
    $database = "aquigaza_fsutt_local";
    $server="181.224.136.219";
    //$server="aquigaza.com";

//    $db=mysqli_connect($server,$user,$pw);
	$db = mysqli_connect('localhost', 'username', 'password', 'database');


	if(!$db)
    {
        echo("Could not connect to database server: " . mysqli_error($con));
        return false;
    }

    if(!mysqli_select_db($database))//Selects the required database
    {
        $s=mysqli_error($con);
        echo("Could not select database ${database}: ${s}");
        return false;
    }

    return $db;//Returns the connection
}

// It is used to send variables to mysql. If this function is not used
// then the ints are sent with '' so you get an error from MySQL
function escapeString($str)
{
    if (get_magic_quotes_gpc()==1)
        $str = stripslashes($str);

    return mysqli_real_escape_string($con,$str);
}
?>
