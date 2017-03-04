<html>
<head>
	<title>ISTS Finance - Balance</title>
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
                $( "#country_select" ).change(function () {
                        var str = "";
                        $( "select option:selected" ).each(function() {
                                var country_name = $( this ).text();
                                $.get( "get_conflicts.php?country="+country_name, function( data ) {
                                  $( "#conflict_data" ).html( data );
                                });                             
                        });
                }).change();
                var my_country = "<?php echo get_name($backend,$scheme,$port,$_SESSION['session']); ?>";
                $("#country_select option").each(function(){
                        if($(this).text()==my_country){
                                $(this).attr("selected","selected");
                                var country_name = $( this ).text();
                                setTimeout(function(){
                                }, 500);                                
                                $.get( "get_conflicts.php?country="+country_name, function( data ) {
                                  $( "#conflict_data" ).html( data );
                                });                                     
                        }
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
			<table><td><img src="images/icons/balance.png" class="title_icon" /></td><td id="titletext">Balance</td></table></div>
		</div>
		<div id="data">

			<div id="page_data">
				Your balance is: <div id="bal">Loading...</div><br /><br />
				<form id="sub">
                                Send $ <input style="width:60px;" type="input" /> to 
                                <select id="country_select">
                                  <option>Australia</option>
                                  <option>Brazil</option>
                                  <option>Canada</option>
                                  <option>China</option>
                                  <option>United Kingdom</option>
                                  <option>Germany</option>
                                  <option>India</option>
                                  <option>Japan</option>
                                  <option>Russia</option>
                                  <option>South Africa</option>
                                  <option>United States</option>
                                </select>
				<input type="submit" value="Transfer">
				</form>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>
