<html>
<head>
	<title>ISTS - Log In</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
$( document ).ready(function() {
	$("#login_form").submit(function(e){
		e.preventDefault();
		$.get( "get_login.php?username="+$("#username").val()+"&password="+$("#password").val(), function( data ) {
			if(data == "TRUE"){
				document.location.href = "/ists.php";
			}else{
				$("#result").html(data);
			}
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
			<table><td><img src="images/icons/signin.png" class="title_icon" /></td><td id="titletext">Login</td></table></div>
		</div>
		<div id="data">
			<div id="page_data">
				<div style="color:red;" id="result"></div>
				Log in here to access protected services.

				<div id="lockbox">
					<table id="sign_table">
						<tr>
						<td><img src="images/icons/security.png" />
					</td><td>
					<div id="login_box">

						<form method="post" id="login_form" autocomplete="off">
							<label for="username">Country:&nbsp;&nbsp;&nbsp;</label> <input type="text" id="username" name="username" value="" maxlength="25" tabindex="1" /><br>
							<label for="password">Password:</label> <input id="password" name="password" tabindex="2" type="password"/><br /><br />
							<input class="logon" value="Log On" type="submit"/>
						</form>
					</div>
					</td>
					</table>
				</div>

			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>