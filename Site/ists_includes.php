	<?php
		$team_settings = parse_ini_file("ists_settings.ini");
	?>
	<link rel="stylesheet" type="text/css" href="istscss.php?teamname=<?php echo $team_settings['name']; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
		var gov_list = '<li><a id="home" href="ists.php">Home</a></li>\
						<li><a id="allies" href="ists2.php">Allies</a></li>\
						<li><a id="resources" href="ists2.php">Resources</a></li>\
						<li><a id="declare war" style="color:red;" href="ists2.php">Declare War</a></li>';
						
		var fin_list = '<li><a id="home" href="ists_fin.php">Home</a></li>\
						<li><a id="resources" href="ists2_fin.php">About</a></li>\
						<li><a id="x" href="ists2_fin.php">Pay Bills</a></li>\
						<li><a id="allies" href="ists2_fin.php">Check Balance</a></li>';	
		var title = document.getElementsByTagName("title")[0].innerHTML.toLowerCase();
			
		$( document ).ready(function() {
			// Select which button we're using
			if(title.search("finance") > -1){
				$("#finance_but").addClass("active");
				$("#gov_but").removeClass("active");
				$("#menuul").html(fin_list);
			}else{
				$("#gov_but").addClass("active");
				$("#finance_but").removeClass("active");				
				$("#menuul").html(gov_list);			
			}
			// Control Scorlling
			if(title.search("home") > -1){
				$("#splash").show();
				$(document.body).on('click', 'a' ,function(e){
					e.preventDefault();
					var id = $(this).attr('id');
					if(id.search("home") == -1){
						var goTo = this.getAttribute("href");
						$("#splash").slideUp( "slow", function() {
							window.location = goTo;
						});  
					}
				});
			}else{
				$("#splash").hide();
				$(document.body).on('click', 'a' ,function(e){
					e.preventDefault();
					var id = $(this).attr('id');
					if(id.search("home") != -1){
						var goTo = this.getAttribute("href");
						$("#splash").slideDown( "slow", function() {
							window.location = goTo;
						});  
					}
				});				
			}
			// Stuff for changing menues
			$('.option').css( 'cursor', 'pointer' );
			$(".option").click(function() {
				if(!$(this).hasClass( "active" )){
					// Remove all actives
					$(".option").removeClass("active");
					$(this).addClass("active");
					if(($(this).text().trim()) == "Financial Services"){
						$("#menuul").html(fin_list);
					}else{
						$("#menuul").html(gov_list);
					}

				}
			});
		});
	</script>