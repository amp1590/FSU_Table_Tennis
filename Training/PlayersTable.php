<p class="mainTitle"> Tables assignment </p>
<table class="mainTable">
		<?php
		if(!empty($training_players)){
			echo "<tr>";
			$columns = array("Table #","Player 1","Player 2");// Used to initialize fields for this table
			foreach($columns as $col){ echo "<th class='players'>$col</th>"; }
			echo "<td class='$class' style='text-align: center;width: 70px'>
				<input type='button' value='New day' onclick='clearTraining()'/></td></tr>\n";
			echo "</tr>";

			$count = 0;
			$table = 1;
			while($count < count($training_players) ){
				if( fmod($table,2) == 0){
					$class = 'oddrow';
				}else{
					$class = 'evenrow';
				}

				echo "<tr>";
				echo "<td class='$class'><b>Table</b>:",$table,"</td>\n";
				echo "<td class='$class'>",$training_players[$count][0],"</td>\n";
				$count ++;
				if($count < count($training_players) ){
					echo "<td class='$class'>",$training_players[$count][0],"</td>\n";
				}else{
					echo "<td class='$class'>Robot</td>\n";
				}
				$count ++;
				$table ++;
				echo "</tr>";
			}
		}
		?>
</table>

<p class="mainTitle"> Players </p>
<table class="mainTable">
	<input type="hidden" id="master" value="<?=$master?>" />
		<?php

		if(!empty($players)){

			echo "<tr>";
			$columns = array("Place", "Name","Training Today");// Used to initialize fields for this table
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
							echo "<td class='$class'>",$row[1],", ",$row[2],"</td>\n";//Name and lastname
					echo "<td class='$class' style='text-align: center;'>",$row[8],"</td>\n";// Is training 

					echo "<td class='$class' style='text-align: center;width: 70px'>
						<input type='button' value='Is Training' onclick='isTraining(",$row[0],")'/></td>\n";
					echo "<td class='$class' style='text-align: center;width: 70px'>
						<input type='button' value='Is Weak' onclick='isNotTraining(",$row[0],")'/></td></tr>\n";
			}
		}
		?>
</table>
