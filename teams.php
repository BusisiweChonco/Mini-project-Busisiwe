<?php
include("connect.php"); 
$table = "";
$error = "";
$message = "";

//Add a team
	if(isset($_POST["submit"])){
		if(isset($_POST["team-name"]) || !empty($_POST["team-name"]) && (isset($_POST["team_email"]) || !empty($_POST["team_email"]))){
			$sql = "INSERT INTO teams Value(NULL, '".$_POST["team-name"]."', '".$_POST["team-email"]."')";
			//mysqli_query($mysqli,$sql);
			
			if (mysqli_query($conn, $sql)) {
				$message = "New team added successfully";
			} else {
				$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			
		}else{
			$error = "Please insert a team name and email.<br>";		
		}
	}
	
//Update team
	if(isset($_GET['method']) && !empty($_GET['method'])){
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			$id = preg_replace("/[^0-9]/","",$_GET["id"]);

			if($_GET['method'] === "update"){
				$query = "SELECT * FROM teams WHERE team_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<form method='post' action=''>";
				$table .= "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Team</th>";
				$table .= "<th>Team email</th>";
				$table .= "<th>Actions</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$table .= "<tr>";
						$table .= "<td><input name='update-name' type='text' value='".$row["team_name"]."'><input name='id' type='hidden' value='".$row["team_id"]."'></td>";
						$table .= "<td><input name='update-email' type='text' value='".$row["team_email"]."'><input name='id' type='hidden' value='".$row["team_id"]."'></td>";
						$table .= "<td><input name='continue-update' type='submit' value='Done'></td>";
							}
						}
						$table .= "</table></form><br><br><br>"; //Remove br lines		
				}else if($_GET['method'] === "del"){
					$query = "DELETE FROM teams WHERE team_id = '$id'";
					$result = mysqli_query($conn,$query);
					$table = "";
				}
			}
		}
	if(isset($_POST['continue-update'])){
		if(isset($_POST["id"]) && !empty($_POST["id"]) && !empty($_POST["update-name"]) && !empty($_POST["update-email"])){
			$id = preg_replace("/[^0-9]/","",$_POST["id"]);
			$query = "UPDATE teams SET team_name = '".$_POST['update-name']."',team_email = '".$_POST['update-email']."' WHERE team_id = '$id'";
			$sql = "UPDATE teams SET team_email = '".$_POST['update-email']."' WHERE team_id = '$id'";
			$result = mysqli_query($conn,$query);
			$sql = mysqli_query($conn,$query);
			$table = "";
		}	
	}
	
	
//Delete teams
		if(isset($_GET['method']) && !empty($_GET['method'])){
			if(isset($_GET["id"]) && !empty($_GET["id"])){
				$id = preg_replace("/[^0-9]/","",$_GET["id"]);

				if($_GET['method'] === "confirm-del"){
					$query = "SELECT * FROM teams WHERE team_id = '$id'";
					$result = mysqli_query($conn, $query);
					$table = "<table>";	
					$table .=  "<tr>";
					$table .= "<th>Team</th>";
					$table .= "<th>Team email</th>";
					$table .= "<th>Actions</th>";
					$table .= "</tr>";
					
					if (mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
								$table .= "<tr>";
								$table .= "<td>".$row["team_name"]."</td>";
								$table .= "<td colspan='4'>Do you want to delete ".$row['team_name']." <a href='".$_SERVER['PHP_SELF']."?id=".$id."&method=del'>Yes</a> | <a href='".$_SERVER['PHP_SELF']."'>No</a></td>";
						}
					}
					$table .= "</table><br><br><br>"; //Remove br lines		
				}else if($_GET['method'] === "del"){
					$query = "DELETE FROM teams WHERE team_id = '$id'";
					$result = mysqli_query($conn,$query);
					$table = "";
				}
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="" type="text/css" />
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
 <style>
 a {
   text-decoration: none;
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
 table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
 </style>
<title></title>
<header>
	<nav>
		<ul>
			<li><a href="competitions.php">Competitions</a></li>
			<li  class="active"><a href="teams.php">Teams</a></li>
			<li><a href="fixtures.php">Fixtures</a></li>
			<li><a href="player_position.php">Player Positions</a></li>
			<li><a href="players.php">Player</a></li>
			<li><a href="player_fixtures.php">Player Fixtures</a></li>
			<li><a href="reports.php">Reports</a></li>
		</ul>
	</nav>
</header>
</head></br>
<body>

<?php

	if($table === ""){
		$query = "SELECT * FROM teams";
		$result = mysqli_query($conn, $query);
		$table = "<table>";	
		$table .=  "<tr>";
		$table .= "<th>Team</th>";
		$table .= "<th>Team email</th>";
		$table .= "<th>Actions</th>";
		$table .= "</tr>";
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$table .= "<tr>";
				$table .= "<td>".$row["team_name"]."</td>";
				$table .= "<td>".$row["team_email"]."</td>";
				$table .= "<td colspan='2'><a href='".$_SERVER['PHP_SELF']."?method=update&id=".$row['team_id']."'>edit</a> | <a href='".$_SERVER['PHP_SELF']."?id=".$row["team_id"]."&method=confirm-del' >delete</a></td>";
				
			}
		}else{
			$message = "There are no teams!";
		}
		
	
		$table .= "</table><br><br><br>"; //Remove br lines
		$table .=	'<form method="post" action="">
					
						<label for="team-name">Team</label><input type="text" name="team-name" required id="team-name"><br>
						<label for="team-email">Team email</label> <input type="email" name="team-email" required id="team-email"><br>
						<?= $error; ?>
						<input type="submit" name="submit" value="submit">
					</form>';		
	}	
	
	echo $table;
	echo $error;
	echo $message;

?>



</body>

</html>