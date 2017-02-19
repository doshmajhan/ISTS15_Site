<html>
<head>
	<title>ISTS - Scoreboard</title>
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
			<table><td><img src="images/icons/score.png" class="title_icon" /></td><td id="titletext">Scoreboard</td></table></div>
		</div>
		<div id="data">
			<div id="page_data">
				<iframe style="margin-left:auto; margin-right:auto;" width=98% height=100% src="<?php echo $team_settings['scoreboard']; ?>"></iframe>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>