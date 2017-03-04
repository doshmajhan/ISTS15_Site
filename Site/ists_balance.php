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

                $( "#sub" ).submit(function (e) {
			e.preventDefault();
                        $.get( "change_settings.php?"+$("#sub").serialize(), function( data ) {
                        	$( "#tran_data" ).html( data );
			    setTimeout(function() {
			        $("#tran_data").hide('blind', {}, 500)
			    }, 5000);
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
			<table><td><img src="images/icons/balance.png" class="title_icon" /></td><td id="titletext">Balance</td></table></div>
		</div>
		<div id="data">

			<div id="page_data">
				Your balance is: <div id="bal">Loading...</div><br /><br />
 				<div id="tran_data"></div>
				<form id="sub">
				<input type="hidden" name="transfer" value="true">
                                Send $ <input style="width:60px;" name="amount" type="input" /> to 
                                <select id="country_select" name="dest">
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
