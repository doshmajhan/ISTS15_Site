	<div id="header">
		<div id="top_menu">
			<table id="head_table">
			<tr>
			<td id="logo">
			<div >
				<p id="ccode"><?php echo $team_settings['code']; ?></p><p id="country"><?php echo $team_settings['remainder']; ?></p><p id="domain">.gov</p>
			</div>
			</td>
			<td id="gov_but"  class="option active">
				Government Services
			</td>
			<td id="finance_but" class="option">
				Financial Services
			</td>
			<td id="login">
				<?php
					include_once('ists_includes.php');
					if(isset($_SESSION['logged_in']) and $_SESSION['logged_in'] === "TRUE"){
						echo "Welcome " . get_name($backend,$scheme,$port,$_SESSION['session']);
						echo ', <a id="logout" href="ists_logout.php">Log Out</a>';
					}else{
						echo '<a id="login" href="ists_login.php">Log In</a>';
					}
				?>
				
			</td>
			</tr>
			</table>
		</div>
		<div id="bot_menu">
			<table>
			<tr>
			<td>
			<ul id="menuul">
				<!-- Placeholder -->
			</ul>
			</td>
			</div>
			</td>
			</tr>
			</table>
		</div>
	</div>