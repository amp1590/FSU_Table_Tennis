<?php include("Header.php"); ?>

<script type="text/javascript">
	var fileName = "Clubs/ClubsManager.php";// Sets the file name to redirect the AJAX calls

	function addField(){ //Validate the new club
		clubName = $('#clubName').val();
		var url = fileName+"?action=add&clubName="+clubName;
		url = addMaster(url);
		runPageAjaxIntTable(url);

		$('#clubName').text("");
	}

	function updateField(id){ //Validate the new club
		clubName = $('#Name').val();
		var url = fileName+"?action=update&id="+id+"&Name="+clubName;
		url = addMaster(url);
		runPageAjaxIntTable(url);
	}

</script>

<div id="main_div" class="content">
		<input type="text" id="clubName" value="NewClub" />
		<input type="button" value="Add Club" onclick="addField();" />
		<div id="result"></div>
		<div id="main_table_div">
			<?php include("Clubs/ClubsManager.php"); ?>
		</div>
</div>
	
<?php include("Footer.php"); ?>