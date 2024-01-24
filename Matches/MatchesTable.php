<p style="background-color: antiquewhite">Club:
<select id="clubs" onchange="selectClub();">
	<option value="All" selected> All </option>
	<?php
	foreach ($clubs as $row) {
		if ($sel_club != $row[0]) {
			echo "<option value=", $row[0], " >", $row[1], "</option>";
		} else {
			echo "<option value=", $row[0], " selected>", $row[1], "</option>";
		}
	}
	?>
</select>
</p>

<table>
	<tr style="background-color: antiquewhite"><td>Winner</td><td>Looser</td></tr>
	<tr>
		<td> <select id="winner">
				<?php
				foreach ($playersWin as $row) {
					echo "<option value=", $row[0], " selected>", $row[1], ", ", $row[2], ". ", $row[3], "</option>\n";
				}
				?>
			</select> </td>
		<td> <select id="loser">
				<?php
				foreach ($playersLos as $row) {
					echo "<option value=", $row[0], " selected>", $row[1], ", ", $row[2], ". ", $row[3], "</option>\n";
				}
				?>
			</select> </td>
		<td><input type="button" value="Add Match" onclick="addMatch();" /></td>
	</tr>
	<!--<tr>
		<td><input id="win_text" type="text" onchage="updateWin();"/></td>
		<td><input id="los_text" type="text" onchage="updateLos();"/></td>
	</tr>-->
</table>
<table class="mainTable" border="1">
	<tr>
		<th>Winner</th>
		<th>Old rat</th>
		<th>New rat</th>
		<th>Loser</th>
		<th>Old rat</th>
		<th>New rat</th>
		<th>Date</th>
	</tr>
	<?php
	if (!empty($matches)) {
		$count = 0;
		$class = 'oddrow';
		foreach ($matches as $row) {
			if (fmod($count, 2) == 0) {
				$class = 'oddrow';
			} else {
				$class = 'evenrow';
			}
			$count ++;

			echo "<tr>\n";
			echo "<td class='$class'>" . $row[1] . ", " . $row[2] . "</td>\n";
			echo "<td class='$class'>" . $row[3] . "</td>\n";
			echo "<td class='$class'>" . $row[4] . "</td>\n";
			echo "<td class='$class'>" . $row[5] . ", " . $row[6] . "</td>\n";
			echo "<td class='$class'>" . $row[7] . "</td>\n";
			echo "<td class='$class'>" . $row[8] . "</td>\n";
			echo "<td class='$class'>" . $row[9] . "</td>\n";

			if ($allowDelete) {
				echo "<td  class='$class' style='text-align: center;width: 70px'><input type='button' value='Delete' onclick='deleteField(", $row[0], ")'/></td></tr>\n";
			}
		}
	}
	?>

</table>
<br>
<div id="result"></div>