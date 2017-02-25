<html>
<head>
	<title>ISTS Finance - Store</title>
	<?php
		include_once('ists_includes.php');
		$myfile = fopen("merch.txt", "r") or die("Unable to open file!");
		$arr = explode("\n",fread($myfile,filesize("merch.txt")));
		fclose($myfile);
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
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<script src="js/modernizr.custom.js"></script>
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
			<table><td><img src="images/icons/store.png" class="title_icon" /></td><td id="titletext">Store</td></table></div>
		</div>
		<div id="data">
		<div class="container">
			<div id="cbp-pgcontainer" class="cbp-pgcontainer">
				<ul class="cbp-pggrid">
				<?php
				array_pop($arr);
				foreach($arr as $val){
					$x = (explode(" - ",$val));
					if(isset($x[2])){
						$img = $x[2];
					}else{
						$img = "giphy.gif";
					}
					if(isset($x[1])){
						$cost = str_replace(',','',$x[1]);
						$cost = number_format(intval($cost));
					}else{
						$cost = "Please Ask";
					}
					echo '<li>
						<div class="cbp-pgcontent">
							<div class="cbp-pgitem">
								<div class="cbp-pgitem-flip">
									<img height=10% width=40% src="images/'. $img .'" />
								</div>
							</div>
						</div>
						<div class="cbp-pginfo">
							<h3>'.$x[0].'</h3>
							<span class="cbp-pgprice">$'.$cost.'</span>
						</div>
					</li>';
					}
					?>
				</ul>
			</div>
		</div>
		<script src="js/cbpShop.min.js"></script>
		<script>
			var shop = new cbpShop( document.getElementById( 'cbp-pgcontainer' ) ); 
		</script>
		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>
