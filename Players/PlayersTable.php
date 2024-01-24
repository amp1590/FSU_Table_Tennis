<p class="mainTitle"> Players </p>
<p class="subTitle"> Filter by Club:
<?php
	echo "<select id='filt_club' onchange='selectClub();'>\n";
	echo "<option value='All' selected>All</option>\n ";
	foreach($clubs as $club){

		if(!empty($sel_club) && $sel_club == $club[0]){
				echo "<option value='",$club[0],"' selected>",$club[1],"</option>\n";//Shows the 2 field of the dependency (Name)
		}else{
			echo "<option value='",$club[0],"'>",$club[1],"</option>\n";//Shows the 2 field of the dependency (Name)
		}
	}
	echo "</select><br>\n";
?>
</p>

<table class="mainTable">
		<input type="hidden" id="master" value="<?=$master?>" />
		<?php

		if(!empty($players)){

			echo "<tr>";
			$columns = array("Place", "Name", "Rating", "USATT","Club","Email");// Used to initialize fields for this table
			foreach($columns as $col){ echo "<th class='players'>$col</th>"; }
			echo "</tr>";

			$count = 0;
			foreach($players as $row){
				if( fmod($count,2) == 0){
					$class = 'oddrow';
				}else{
					$class = 'evenrow';
				}

				echo "<tr>";
				$count ++;

				$curr_club = getClub($row[5]); 

				echo "<td class='$class' style='text-align: right'>$count</td>\n";
				if($editRow == $row[0]){
					echo "<td class='$class'><input type='text' id='uname' value='",$row[1],"' /><input type='text' id='ulast_name' value='",$row[2],"' /></td>\n";
					echo "<td class='$class'><input type='text' id='uclub_rat' value='",$row[3],"' /></td>\n";
					echo "<td class='$class'><input type='text' id='uusatt_rat' value='",$row[4],"' /></td>\n";
					echo "<td class='$class'><select id='uclubs'>";
						foreach($clubs as $club){
							if($curr_club[0][0] == $club[0]){
								echo "<option value='",$club[0],"' selected>",$club[1],"</option>";//Shows the 2 field of the dependency (Name)
							}else{
								echo "<option value='",$club[0],"'>",$club[1],"</option>";//Shows the 2 field of the dependency (Name)
							}
						}
					echo "</select></td>";
//					echo "<td class='$class'>",$row[6],"</td>\n";
					echo "<td class='$class'><input type='text' id='uemail' value='",$row[7],"' /></td>\n";
				}else{
					echo "<td class='$class'>",$row[1],", ",$row[2],"</td>\n";//Name and lastname
					echo "<td class='$class' style='text-align: right'>",$row[3],"</td>\n";// Rating
					echo "<td class='$class' style='text-align: right'>",$row[4],"</td>\n";// USATTA Rating
					echo "<td class='$class'>",$curr_club[0][1],"</td>\n";// USATTA Rating
//					echo "<td class='$class'>",$row[6],"</td>\n";//Date
					echo "<td class='$class'>",$row[7],"</td>\n";// Email
				}

				if($allowEdit){
					if($editRow == $row[0]){
						echo "<td class='$class' style='text-align: center;width: 70px'>
							<input type='button' value='Update' onclick='updateField(",$row[0],")'/></td>\n";
					}else{
						echo "<td class='$class' style='text-align: center;width: 70px'>
							<input type='button' value='Edit' onclick='editField(",$row[0],")'/></td>\n";
					}
				}
				if($allowDelete){
					echo "<td class='$class' style='text-align: center;width: 70px'>
						<input type='button' value='Delete' onclick='deleteField(",$row[0],")'/></td></tr>\n";
				}
			}
		}
		?>
</table>
