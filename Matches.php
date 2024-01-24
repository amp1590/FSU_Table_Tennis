<?php
include("Header.php");
?>

<script type="text/javascript">
	var fileName = "Matches/MatchesManager.php";// Sets tde file name to redirect tde AJAX calls
	$("#tabplayers").removeClass("active");//Change tab active menu
	$("#tabmatches").addClass("active");//Change tab active menu
	$("#tabgraphs").removeClass("active");//Change tab active menu

	function addMatch(){ 
		id_won = $('#winner').val();
		id_lost= $('#loser').val();

		if( id_won == id_lost){
			alert("The players most be different");
		}else{
			var url = fileName+"?action=add"+
				"&id_won="+id_won+
				"&id_lost="+id_lost;
			runPageAjaxIntTable(url);
		}
	}

	function updateField(id){ //Validate the new club
		clubName = $('#Name').val();
		var url = fileName+"?action=update&id="+id+"&Name="+clubName;
		runPageAjaxIntTable(url);
	}

	function selectClub(){
		id_club = $('#clubs').val();
//		alert(id_club);
		if(id_club != "All"){
			url = fileName+"?&sel_club="+id_club;
		}else{
			url = fileName;
		}
		runPageAjaxIntTable(url);
	}

</script>

<div id="main_div_matches" class="container">
	<p class="mainTitle"> Club matches </p>
	<div id="main_table_div">
		<?php include("Matches/MatchesManager.php"); ?>
	</div>
</div>

<?php include("Footer.php"); ?>