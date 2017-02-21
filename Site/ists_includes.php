	<?php
		$team_settings = parse_ini_file("ists_settings.ini");
		if(!isset($_SESSION)) { session_start(); }		
		include_once('api_calls.php');
	?>
	<link rel="stylesheet" type="text/css" href="istscss.php?teamname=<?php echo $team_settings['name']; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel.pack.js"></script>
	<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.6"></script>
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="/jvectormaps/jquery-jvectormap-2.0.3.min.js"></script>
	<script type="text/javascript" src="/jvectormaps/jquery-jvectormap-world-mill.js"></script>	
	<link rel="stylesheet" href="/jvectormaps/jquery-jvectormap-2.0.3.css" type="text/css" media="screen" />	
	<script>
		var gov_list = '<li id="menu_home"><a id="home" href="ists.php">Home</a></li>\
						<li id="menu_diplomacy"><a id="diplomacy" href="/ists_map.php">Diplomacy</a></li>\
						<li id="menu_resources"><a id="resources" href="/ists_resources.php">Resources</a></li>\
						<li id="menu_conflicts"><a id="conflicts" href="/ists_conflicts.php">World Conflicts</a></li>\
						<li id="menu_scoreboard"><a id="sboard" href="/ists_scoreboard.php">Scoreboard</a></li>';
						
		var fin_list = '<li><a id="home" href="ists_fin.php">Home</a></li>\
						<li><a id="resources" href="ists2_fin.php">About</a></li>\
						<li><a id="x" href="ists2_fin.php">Pay Bills</a></li>\
						<li><a id="allies" href="ists2_fin.php">Check Balance</a></li>';	
		var title = document.getElementsByTagName("title")[0].innerHTML.toLowerCase();
			
		$( document ).ready(function() {
			// Support fancybox on all pages
			$(".fancybox").fancybox();
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
				$("#menu_home").addClass("menuul_active");
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
				if(title.search("diplomacy") > -1){
					$("#menu_diplomacy").addClass("menuul_active");
				}
				if(title.search("resources") > -1){
					$("#menu_resources").addClass("menuul_active");
				}
				if(title.search("conflicts") > -1){
					$("#menu_conflicts").addClass("menuul_active");
				}						
				if(title.search("scoreboard") > -1){
					$("#menu_scoreboard").addClass("menuul_active");
				}	
				$("#splash").hide();
				$(document.body).on('click', 'a' ,function(e){
					e.preventDefault();
					var id = $(this).attr('id');
					if(id.search("home") != -1){
						var goTo = this.getAttribute("href");
						$("#splash").slideDown( "slow", function() {
							window.location = goTo;
						});  
					}else{
						var goTo = this.getAttribute("href");
						window.location = goTo;
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