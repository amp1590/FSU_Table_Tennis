<?php
include("Header.php");
include("PHP/DBadmin.php");
include("PHP/CommonSQL.php");
include("Clubs/ClubsSQL.php");
include("Players/PlayersSQL.php");
?>

<script type="text/javascript">
	var fileName = "Players/PlayersManager.php";// Sets tde file name to redirect tde AJAX calls

	$("#tabplayers").addClass("active");
	$("#tabmatches").removeClass("active");//Change tab active menu
	$("#tabgraphs").removeClass("active");//Change tab active menu

	function addField() {
		name = $('#name').val();
		last = $('#last_name').val();
		club_rat = $('#club_rat').val();
		usatt_rat = $('#usatt_rat').val();
		id_club = $('#clubs').val();
		email = $('#email').val();
		var url = fileName + "?action=add" +
				"&name=" + name +
				"&last_name=" + last +
				"&club_rat=" + club_rat +
				"&usatt_rat=" + usatt_rat +
				"&id_club=" + id_club +
				"&email=" + email;
		url = addMaster(url);
		runPageAjaxIntTable(url);
	}
	function selectClub() {
		id_club = $('#filt_club').val();
		master = $('#master').val();
//		alert("Selected club: "+id_club);

		if (id_club != "All") {
			url = fileName + "?&sel_club=" + id_club;
		} else {
			url = fileName + "?";
		}
		url = addMaster(url);

		runPageAjaxIntTable(url);
	}

	function updateField(id) {
		name = $('#uname').val();
		last = $('#ulast_name').val();
		club_rat = $('#uclub_rat').val();
		usatt_rat = $('#uusatt_rat').val();
		id_club = $('#uclubs').val();
		email = $('#uemail').val();
		var url = fileName + "?action=update" +
				"&id_play=" + id +
				"&name=" + name +
				"&last_name=" + last +
				"&club_rat=" + club_rat +
				"&usatt_rat=" + usatt_rat +
				"&id_club=" + id_club +
				"&email=" + email;
		url = addMaster(url);
//		alert(url);
		runPageAjaxIntTable(url);
	}

</script>
	
<div id="main_div_players" class="container">
	<div class="row">
		<div class="col-md-12 " id="main_table_div">
			<?php include("Players/PlayersManager.php"); ?>
		</div>
			
		<div class="col-md-4" id="new_player">
			<p class="mainTitle"> New Player</p>
			<form role="form">
				<div class="form-group" style="background-color: antiquewhite">
					<label>Name</label> <input class="form-control" type="text" id="name" />
					<label>Last name</label> <input  class="form-control" type="text" id="last_name" />
					<label>Club Rating</label> <input  class="form-control" type="text" id="club_rat" />
					<label>Email</label><input  class="form-control" type="text" id="email" />
					<label>USATT Rating</label><input  class="form-control" type="text" id="usatt_rat" />
					<label>Club</label> <select  class="form-control" id="clubs">
										<?php
										$clubs = getClubs(); //Obtains all the clubs
										foreach ($clubs as $row) {
											echo "<option value=", $row[0], " selected>", $row[1], "</option>"; //Shows the 2 field of the dependency (Name)
										}
										?> </select>
				</div>
				<input type="button" value="Add new player" onclick="addField();" />
			</form>
			<div id="result"></div>
		</div>
	</div><!-- row -->
		
</div>

<?php include("Footer.php"); ?>