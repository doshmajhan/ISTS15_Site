<?php header("Content-type: text/css; charset: UTF-8"); ?>
body {
	margin: 0;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	max-width: 100%;
}

#top_menu {
	display: relative;
	height: 42px;
	background-color: #FFFFF;
	margin-bottom: -6px;

}
#head_table {
	width: 100%;

}
#logo {
	position:relative;
	padding-left: 5%;
	width: 35%;
	min-width: 300px;	
}
#ccode {
	display: inline;
	color: black;
	font-family: "Arial Black";
	font-size: 36px;
}
#country {
	display: inline;
	color: #046791;
	font-family: "Arial Black";
	font-size: 36px;
}
#domain {
	display: inline;
	color: #949494;
	font-family: "Arial";
	font-size: 36px;	
}
#login {
	position: relative;
	padding-left: 20%;
}
.option {
	height: 42px;
	width: 180px;
	color: black;
	min-width: 180px;
	text-align: center;
}
.active {
	height: 45px;
	background-color: #046791;
	color: white;
}
#bot_menu {
	position: relative;
	top: 16px;
	height: 65px;
	min-width: 900px;
	background-color: #046791;
}
#menuul {
	position: relative;
	padding-left: 10%;
    list-style-type: none;
    padding: 0;
	margin: 0;
}

#menuul li {
    float: left;
}

#menuul li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 13px;
    text-decoration: none;
}

#menuul li a:hover {
    background-color: #FFF;
	color: black;
}
#searchbar {
	position: relative;
	padding-left: -20%;
}
.btn {
	text-transform: uppercase;
	color: #fff;
	background-color: #063346;
	border-radius: 0;
    text-shadow: none;
	border: none;
	font-family: "Open Sans";
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
	-webkit-font-smoothing: antialiased;
}

.btn:hover {
	background-color: #46aee5;

}

#splash {
	position: relative;
	display: none;
	height: 400px;
	margin: 0;
	background: black;
	background: linear-gradient(to right,rgba(0,0,0, 100)60%,rgba(0,0,0, 0)),url(images/<?php echo $_GET['teamname']; ?>.png);

	background-position: right;
}
#splash_text {
	position: absolute;
	font-family: "Arial";
	min-width: 850px;
	left: 5%;
	top: 10%;
	font-size: 65px;
	color: white;
	z-index: 1;
}
#splash_button1 {
	position:absolute;
	left: 8%;
	top: 60%;
	width: 23%;
	z-index: 1;
}
#splash_button2 {
	position:absolute;
	left: 26%;
	top: 60%;
	width: 23%;
	z-index: 1;

}
.ctrbtn {
	width: 60%;	
	background-color: green;
	font-size: 32px;	
	color: white;
	min-width: 165px;
	border-radius: 0;
    text-shadow: none;
	border: none;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
	-webkit-font-smoothing: antialiased;	
}
#splashimg {
	position: relative;
	float: right;
	height: 400px;
	z-index: 0;
}
#content{
	position: relative;
}
#title {
	position: relative;
	height: 100px;
	background-color: #04689b;
	border: 1px solid black;
}
#titletext{
	position: relative;
	font-size: 28px;	
	color: white;
	text-transform: uppercase;
	padding-left: 10%;
	top: 30%;
}
#data {
	position: relative;
	color: white;
	height: 270px;
	min-height: 270px;
	background-color: #17415f;
}
#page_data {
	position: relative;
	padding-top: 1%;
	max-width: 100%;
	min-width: 100%;
	min-height: 100%;
	margin-left: 0%;
	margin-right: 30%;
	text-align: center;
	color: white;

}
#lockbox {
	position: absolute;
	left:15%;
	top: 20%;
	min-width: 50%;
}
#login_box {
	position: relative;
	left: 05%;
	margin-top: -40%;
	min-height: 100%;
}
#footer {
	position: relative;
	height: 55px;
	background-color: #04689b;
	text-align: center;
	color: white;
	font-family: "Arial Bold";
	font-size: 20px;	
}