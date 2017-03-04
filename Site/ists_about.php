<html>
<head>
	<title>ISTS Finance - About</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {
		$.get( "change_settings.php?balance=true", function( data ) {
			  $( "#bal" ).html( data );
		
		});
		setInterval(function(){
			$.get( "change_settings.php?balance=true", function( data ) {
				  $( "#bal" ).html( data );
			
			});
		}, 3000);		

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
			<table><td><img src="images/icons/about.png" class="title_icon" /></td><td id="titletext">About</td></table></div>
		</div>
		<div id="data">

			<div id="page_data1" style="width:500px; text-align:center;margin:auto;margin-top:25px;">
Welcome To Bank of SPARSA<br />You can buy many things with the money you make being a bank. Be sure to keep your services up so that you can make money! Each check is worth $7812.5 and 8 services are monitored for potential $62500 per round. Rounds are undertaken every 5 minutes. Remember that your money doesn't play into your overall score. If you have extra funds, please take a look at the wide verity of offerings we provide.
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>
