<?php
include("Header.php");
include("PHP/DBadmin.php");
include("PHP/CommonSQL.php");
include("Clubs/ClubsSQL.php");
include("Players/PlayersSQL.php");
?>

<script type="text/javascript">
	var fileName = "Graphs/GraphsManager.php";// Sets tde file name to redirect tde AJAX calls

	$("#tabplayers").removeClass("active");//Change tab active menu
	$("#tabmatches").removeClass("active");//Change tab active menu
	$("#tabgraphs").addClass("active");//Change tab active menu

	function graphHistory() {
		id = $('#playerId').val();
		var url = fileName + "?action=graphHistory" +
				"&id=" + id;
		runPageAjaxIntTable(url);
	}

	// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages': ['corechart']});

</script>

<div id="main_div_graph" class="container ">
	<p class="mainTitle"> Players performance</p>
	<select id="playerId" onchange="graphHistory();">
		<?php
		$players = getAllPlayersOrderBy('last'); //Obtains all the clubs
		foreach ($players as $row) {
			echo "<option value='", $row[0], "' >", $row[2], ", ", $row[1], "</option>"; //Shows the 2 field of the dependency (Name)
		}
		?>
	</select> <input type="button" value="Graph me" onclick="graphHistory();" />
	<div id="main_table_div">
	</div>
	<div id="graph_div"> </div>
</div>

<?php include("Footer.php"); ?>