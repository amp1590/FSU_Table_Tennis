<table border="1">
		<input type="hidden" id="master" value="<?=$master?>" />
		<?php
		if(!empty($table)){

			echo "<tr>";
			foreach($show_columns as $show){
				echo "<th>$columns[$show]</th>";
			}
			echo "</tr>";

			foreach($table as $row){
				echo "<tr>";

				foreach($show_columns as $show){
					if($editRow == $row[0]){
						echo "<td><input type='text' id='",$columns[$show],"' value='",$row[$show],"' /></td>\n";
					}else{
						echo "<td>",$row[$show],"</td>\n";
					}
				}

				if($allowEdit){
					if($editRow == $row[0]){
echo "<td style='text-align: center;width: 70px'><input type='button' value='Update' onclick='updateField(",$row[0],")'/></td>\n";
					}else{
						echo "<td style='text-align: center;width: 70px'><input type='button' value='Edit' onclick='editField(",$row[0],")'/></td>\n";
					}
				}
				if($allowDelete){
					echo "<td style='text-align: center;width: 70px'><input type='button' value='Delete' onclick='deleteField(",$row[0],")'/></td></tr>\n";
				}
			}
		}
		?>
</table>
