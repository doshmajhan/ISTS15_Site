<html>
<head>
	<title>Something</title>
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
			<div id="titletext"><img src="#" />&nbsp;&nbsp;Banking Information</div>
		</div>
		<div id="data">
			<div id="page_data">
				You may log in now in order to access protected services later.

				<div id="lockbox">
					<img src="https://cas.rit.edu/images/paw_lock.jpg" />
					<div id="login_box">
						
						<form method="post" name="login_form" autocomplete="off">		
							<label for="username">Username:</label> <input type="text" name="username" value="" maxlength="25" tabindex="1" /><br>
							<label for="password">Password:</label> <input name="password" tabindex="2" type="password"/><br>
							<input class="logon" value="Log On" type="submit"/>	   
						</form>
					</div>					
				</div>

			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>