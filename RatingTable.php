<?php include("Header.php"); ?>

<script type="text/javascript">
	var fileName = "Rating_table/RatTabManager.php";// Sets the file name to redirect the AJAX calls

	function addRange(){ //Validate the new club
		low = $('#low').val();
		high = $('#high').val();
		exp = $('#expected').val();
		upset = $('#upset').val();
		var url = fileName+"?action=add&low="+low+
					"&high="+high+
					"&exp="+exp+
					"&upset="+upset;

		runPageAjaxIntTable(url);
	}

	function updateField(id){ //Validate the new club
		low = $('#From').val();
		high = $('#To').val();
		exp = $('#Expected').val();
		upset = $('#Upset').val();
		var url = fileName+"?action=update&id="+id+
					"&low="+low+
					"&high="+high+
					"&exp="+exp+
					"&upset="+upset;

		runPageAjaxIntTable(url);
	}

</script>

<div id="main_div" class="content">
		<div id="add_div">
			<table>
				<tr><th>Low range</th><th>High range</th><th>Expected</th><th>Upset</th></tr>
				<tr>
					<td><input type="text" id="low"  /></td>
					<td><input type="text" id="high"  /></td>
					<td><input type="text" id="expected"  /></td>
					<td><input type="text" id="upset"  /></td>
				</tr>
			</table>
			<input type="button" value="Add new range" onclick="addRange();" />
		</div>
		<div id="result"></div>
		<div id="main_table_div">
			<?php include("Rating_table/RatTabManager.php"); ?>
		</div>
</div>
	
<?php include("Footer.php"); ?>
