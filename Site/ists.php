<html>
<head>
	<title>ISTS - Home</title>
	<?php
		include_once('ists_includes.php');
	?>
</head>
<body>
	<?php
		include_once('ists_header.php');
	?>
	<?php
		include_once('ists_splash.php');
	?>
	<div id="content">
		<div id="title">
			<table style="width:25%;"><td><img src="images/icons/actions.png" class="title_icon" /></td><td id="titletext">Popular Activities</td></table></div>			
		</div>
		<div id="data">
			<div id="front_data">
				<table id="front_table">
					<tr>
						<td class="resource_text"><img src="images/icons/score.png" class="front_image" /></td>
						<td class="resource_text"><img src="images/icons/war.png" class="front_image" /></td>
						<td class="resource_text"><img src="images/icons/resources.png" class="front_image" /></td>
						<td class="resource_text"><img src="images/icons/bills.png" class="front_image" /></td>
					</tr>
					<tr>
						<td class="resource_text">Check Score</td>
						<td class="resource_text">Declare War!</td>
						<td class="resource_text">See Resources</td>
						<td class="resource_text">Pay Bills</td>
					</tr>
					<tr>
						<td class="resource_text"><button onclick="window.location.href='/ists_scoreboard.php'" class="btn">See Who is Winning</button></a></td>
						<td class="resource_text"><button onclick="window.location.href='/ists_map.php'" class="btn">Control your Generals</button></td>
						<td class="resource_text"><button onclick="window.location.href='/ists_resources.php'" class="btn">Save the Elephants</button></td>
						<td class="resource_text"><button onclick="window.location.href='/ists_map.php'" class="btn">Keep the lights on</button></td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>