<?php
include("Header.php");
include("PHP/DBadmin.php");
include("PHP/CommonSQL.php");
include("Players/PlayersSQL.php");
?>

<script type="text/javascript">
	var fileName = "Training/TablesManager.php";// Sets tde file name to redirect tde AJAX calls

	$("#tabplayers").addClass("active");
	$("#tabmatches").removeClass("active");//Change tab active menu
	$("#tabgraphs").removeClass("active");//Change tab active menu

	function isTraining(id) {
		console.log("Adding player:"+id);
		var url = fileName + "?action=add&id=" + id;
		runPageAjaxIntTable(url);
	}

	function isNotTraining(id) {
		console.log("Removing player:"+id);
		var url = fileName + "?action=delete&id=" + id;
		runPageAjaxIntTable(url);
	}

	function clearTraining() {
		console.log("New day");
		var url = fileName + "?action=clear";
		runPageAjaxIntTable(url);
	}

	
</script>
	
<div id="main_div_training" class="container">
	<div class="row">
		<div class="col-md-12 " id="main_table_div">
			<?php include("Training/TablesManager.php"); ?>
		</div>
	</div><!-- row -->
</div>
	
<?php include("Footer.php"); ?>
