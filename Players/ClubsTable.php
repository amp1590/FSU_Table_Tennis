<!-- 
<table>
	<?php
	if(!empty($clubs)){

		echo "<tr>";
		foreach($show_columns as $show){
			echo "<th>$columns[$show]</th>";
		}
		echo "</tr>";

		foreach($clubs as $row){
			echo "<tr>";

			foreach($show_columns as $show){
				echo "<td>",$row[$show],"</td>\n";
			}

			echo "<td style='text-align: center;width: 70px'><input type='button' value='Select' onclick='selectClub(",$row[0],")'/></td>\n";
		}
	}
	?>
</table>
-->