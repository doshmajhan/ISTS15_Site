<html>
<head>
	<title>ISTS Finance - Settings</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {
		$( "#changepass" ).click(function () {
			var pass = $("#password").val();
			$.get( "change_settings.php?password="+pass, function( data ) {
			  $( "#result" ).html( data );
			});
		});
		$( "#changepin" ).click(function () {
			var pin = $("#pin").val();
			$.get( "change_settings.php?pin="+pin, function( data ) {
			  $( "#result" ).html( data );
			});
		});		
	});

	</script>
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
			<table><td><img src="images/icons/settings.png" class="title_icon" /></td><td id="titletext">Settings</td></table></div>
		</div>
		<div id="data">

			<div id="page_data">
				<div id="result"></div>
				<label for="password">Change Password:&nbsp;</label><input id="password" type="password" /> <input id="changepass" type="submit" />
				<br /><br /><br /><br />
				<label for="pin">Change Pin:&nbsp;</label><input id="pin" type="password" /> <input id="changepin" type="submit" />
				
				<div id="conflict_data"></div>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>