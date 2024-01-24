<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . "/PHP/DBadmin.php");
require_once(__ROOT__ . "/PHP/CommonSQL.php");
require_once("../Players/PlayersSQL.php");

$action = $_REQUEST["action"];

if ($action == 'graphHistory') {
	$id = $_REQUEST["id"];
	$history = getRatingHistory($id);
	$player = getPlayer($id);
}

?>

<script type="text/javascript">

	// Create the data table.
	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.LineChart(document.getElementById('graph_div'));

	var data = new google.visualization.arrayToDataTable(
			[
				<?php
				echo "['Date','Rating']";
				foreach ($history as $row) {
					echo ",";
					if($row[5] == $id){
						echo "['".$row[7]."',".$row[3]."]";
					}else{
						echo "['".$row[7]."',".$row[4]."]";
					}
				}
				?>
			]);

	// Set chart options
	var options = {title: 'Rating history for <?php echo $player[0][1].", ".$player[0][2]; ?>',
		backgroundColor: 'white',
		hAxis: {fomat: 'yyyy-MM-dd'},
		vAxis:{ title:'Rating',
				viewWindowMode:'explicit',
				viewWindow:{
					max:2600,
					min:600
				}}
		};

	chart.draw(data, options);
	chart.title('sopas');
</script>