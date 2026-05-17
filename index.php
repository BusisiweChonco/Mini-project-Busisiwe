<!DOCTYPE html>
<?php
include 'connect.php';

?>
<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" href="" type="text/css" />
 <meta name="viewport" content="width-device-width, initial-scale=1.0">
 <style>
 html{
	background-image: img src="images/stadium.jpg"  no-repeat center fixed; 
	background-size: cover;
 }
 a {
   text-decoration: none;
 }
 a:link, a:visited {
   color: #330066;
 }
 a:hover, a:active {
   color: #330066;
 }
	Header nav{
   background-color: #0000ff;
   height: 40px;
   border-radius: 5px;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
 }
 Header nav ul {
   list-style: none;
   margin: 0 auto;
 }
 Header nav ul li {
   float: left;
   display: inline;
 }
 Header nav a:link, Header nav a:visited {
   color: #FFF;
   display: inline-block;
   padding: 10px 25px;
   height: 20px;
 }
 Header nav ul li a {
   border-radius: 5px;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
 }
 </style>
<title></title>
<header>
 <nav>
       <ul>
         <li><a href="competitions.php">Competitions</a></li>
         <li><a href="teams.php">Teams</a></li>
         <li><a href="fixtures.php">Fixtures</a></li>
         <li><a href="player_position.php">Player Positions</a></li>
         <li><a href="players.php">Player</a></li>
		 <li><a href="player_fixtures.php">Player Fixtures</a></li>
		 <li><a href="reports.php">Reports</a></li>
      </ul>
     </nav>
</header>
</head>
<body>
<img src="images/stadium.jpg" style="float:left width:5px;height:300pxborder:0;">
</body>
</html>