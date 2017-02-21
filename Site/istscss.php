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

	font-family: "Arial Bold";
	font-size: 20px;		
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

.menuul_active {
    background-color: #063346;
	
}

#menuul li a:hover {
    background-color: #FFF;
	color: black;
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
	padding-left: 10%;

}
#titletext{
	position: relative;
	font-size: 28px;	
	color: white;
	text-transform: uppercase;
	padding-top: 10%;
	padding-left: 5%;

}
.title_icon{
	width: 50px;
	height: 50px;
	padding-top: 35%;	
}
#data {
	position: relative;
	color: white;
	min-height: 270px;
	padding-top:20px;
	padding-bottom: 20px;
	background-color: #17415f;
}
#page_data {
	position: relative;
	padding-top: 1%;
	max-width: 100%;
	min-width: 100%;
	margin-left: 0%;
	margin-right: 30%;
	text-align: center;
	color: white;
}

#sign_table{
	position: relative;
	border-collapse: collapse;
    margin-left:auto; 
    margin-right:auto;	
	
}

.conflict_text{
	color:white;
}
.resource_image{
	width:250px;
	height:250px;
}

#resource_table{
	position:relative;
	width: 100%;
	border-collapse: collapse;
}

#resource_table a{
    color: white;
    text-decoration: none;
}

.resource_text{
	text-align: center;
	color: white;
	font-family: "Arial Bold";
	font-size: 20px;	
}

#conflict_table{
	position: relative;
	border-collapse: collapse;
    margin-left:auto; 
    margin-right:auto;	
}

.front_image{
	width:75px;
	height:75px;
}

#front_table{
    margin-left:auto; 
    margin-right:auto;	
	position:relative;
	width: 60%;
	border-collapse: collapse;
}

.btn {
	margin-top: 25px;
	text-transform: uppercase;
	color: #fff;
	background-color: #0a5c87;
	border-radius: 0;
    text-shadow: none;
	border: none;
	padding: 14px;
	font-family: "Open Sans";
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
	-webkit-font-smoothing: antialiased;
}

.btn:hover {
	background-color: #063346;

}

#map{
	width:100%;
	height:64%;
}

#lockbox {
	position: absolute;
	left:15%;
	top: 20%;
	min-width: 50%;
}
#login_box {
	position: relative;
	left: 30%;
	margin-top: -14%;
	min-height: 100%;
	color: white;
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