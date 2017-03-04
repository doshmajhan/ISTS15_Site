	<div id="splash">
		<div id="splash_text">
			Welcome to <?php echo $team_settings['name']; ?>.<br>
			<?php echo $team_settings['welcome']; ?>.
		</div>
		<div id="splash_button1">
			<a class="fancybox" href="#quick_tour"><button class="ctrbtn">Quick Tour</button></a>
		</div>
		<div id="splash_button2">
			<a class="fancybox" href="#about"><button class="ctrbtn"><?php echo $team_settings['name']; ?> Facts</button></a>
		</div>
		<div id="quick_tour" style="display:none;width:500px;">
			<?php echo $team_settings['about']; ?>
		</div>
		<div id="about" style="display:none;width:500px;">
			<h1>Fun Facts</h1>
			1) <?php echo $team_settings['fact1']; ?><br />
                        2) <?php echo $team_settings['fact2']; ?><br />
		</div>


	</div>
