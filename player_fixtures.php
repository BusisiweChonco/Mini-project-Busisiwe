<?php 
	include("connect.php"); 
	$table = "";
	$error = "";
	$message = "";
	//Add fixture
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
	
	//Update Competition
	if(isset($_GET['method']) && !empty($_GET['method'])){
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			$id = preg_replace("/[^0-9]/","",$_GET["id"]);

			if($_GET['method'] === "update"){
				$query = "SELECT * FROM fixtures WHERE fixture_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<form method='post' action=''>";
				$table .= "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Fixture</th>";
				$table .= "<th>Date</th>";
				$table .= "<th>Time</th>";
				$table .= "<th>Home Team</th>";
				$table .= "<th>Away Team</th>";
				$table .= "<th>Comp</th>";
				$table .= "<th>Action</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$table .= "<tr>";
						
						$table .= "<td><input name='update-date' type='text' value='".$row["fixture_date"]."'><input name='id' type='hidden' value='".$row["fixture_id"]."'></td>";
						$table .= "<td><input name='update-time' type='text' value='".$row["fixture_time"]."'><input name='id' type='hidden' value='".$row["fixture_id"]."'></td>";
						$table .= "<td><input name='update-hometeam' type='text' value='".$row["home_teamID"]."'><input name='id' type='hidden' value='".$row["home_teamID"]."'></td>";
						$table .= "<td><input name='update-awayteam' type='text' value='".$row["away_teamID"]."'><input name='id' type='hidden' value='".$row["away_teamID"]."'></td>";
						$table .= "<td><input name='update-compname' type='text' value='".$row["comp_name"]."'><input name='id' type='hidden' value='".$row["comp_name"]."'></td>";
						$table .= "<td><input name='continue-update' type='submit' value='Done'></td>";
					}
				}
				$table .= "</table></form><br><br><br>"; //Remove br lines		
			}else if($_GET['method'] === "del"){
				$query = "DELETE FROM fixtures WHERE fixture_id = '$id'";
				$result = mysqli_query($conn,$query);
				$table = "";
			}
		}
	}
	if(isset($_POST['continue-update'])){
		if(isset($_POST["id"]) && !empty($_POST["id"]) && !empty($_POST["update-date"]) && !empty($_POST["update-time"]) && !empty($_POST["update-hometeam"]) && !empty($_POST["update-awayteam"]) && !empty($_POST["update-name"])){
			$id = preg_replace("/[^0-9]/","",$_POST["id"]);
			$query = "UPDATE fixtures SET fixture_date = '".$_POST['update-date']."' , fixture_time = '".$_POST['update-time']."', home_teamID = '".$_POST['update-hometeam']."', away_teamID = '".$_POST['update-awayteam']."', comp_name = '".$_POST['update-compname']."'WHERE fixture_id = '$id'";
			$result = mysqli_query($conn,$query);
			$table = "";
		}	
	}

	//Delete fixture
	if(isset($_GET['method']) && !empty($_GET['method'])){
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			$id = preg_replace("/[^0-9]/","",$_GET["id"]);

			if($_GET['method'] === "confirm-del"){
				$query = "SELECT * FROM fixtures WHERE fixture_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Fixture</th>";
				$table .= "<th>Date</th>";
				$table .= "<th>Time</th>";
				$table .= "<th>Home Team</th>";
				$table .= "<th>Away Team</th>";
				$table .= "<th>Comp</th>";
				$table .= "<th>Action</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
							$table .= "<tr>";
							$table .= "<td>".$row["fixture_id"]."</td>";
							$table .= "<td colspan='4'>Do you want to delete ".$row['comp_name']." <a href='".$_SERVER['PHP_SELF']."?id=".$id."&method=del'>Yes</a> | <a href='".$_SERVER['PHP_SELF']."'>No</a></td>";
					}
				}
				$table .= "</table><br><br><br>"; //Remove br lines		
			}else if($_GET['method'] === "del"){
				$query = "DELETE FROM fixtures WHERE fixture_id = '$id'";
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
			<li class="active"><a href="competitions.php">Competitions</a></li>
			<li><a href="teams.php">Teams</a></li>
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
		$home_team = "";
		$away_team = "";
		$query = "SELECT * FROM fixtures";
		$result = mysqli_query($conn, $query);
		$table = "<table>";	
		$table .=  "<tr>";
		$table .= "<th>Player</th>";
		$table .= "<th>Fixture</th>";
		$table .= "<th>Goals Scored</th>";
		$table .= "<th>Actions</th>";
		$table .= "</tr>";
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$sql1 = null;
				$result1 = null;
				$sql1 = "SELECT * FROM players";
				$result1 = mysqli_query($conn, $sql1);
				if(mysqli_num_rows($result1) > 0){
					while($row1 = mysqli_fetch_assoc($result1)){
						if($row["player_name"] == $row1["player_id"]){
							$playername = $row1["player_name"];
						}
					}
				}
				
				$fixture = "$home_team vs $away_team";
				$table .= "<tr>";
				$table .= "<td>".$playername."</td>";
				$table .= "<td>$fixture</td>";
				$table .= "<td>".$row["goals_scored"]."</td>";
				$table .= "<td colspan='2'><a href='".$_SERVER['PHP_SELF']."?method=update&id=".$row['comp_id']."'>edit</a> | <a href='".$_SERVER['PHP_SELF']."?id=".$row["comp_id"]."&method=confirm-del' >delete</a></td>";
				
			}
		}else{
			$message = "Players fixture information is empty";
		}
		
		$table .= "</table><br><br><br>"; //Remove br lines
		
					
	}	
	
	echo $table;
	
	
	?>
	<form method="post" action="">
		<label>Add Player fixture</label><br>
		<label for="player-name">Player</label> 
		<select name="player-name" id="player-name">
		<?php	
			$sql1 = "SELECT * FROM players"; 
			$result1 = mysqli_query($conn, $sql1);
			if (mysqli_num_rows($result1) > 0){
				while($row = mysqli_fetch_assoc($result1)){
					echo "<option value='" . $row['player_id'] ."'>" . $row['player_name'] ."</option>";
				}
			}
		?>
		</select><br>
		<label for="fixture">Fixture</label> 
		<select name="fixture-name" id="fixture-name">
		<?php	
			$sql1 = "SELECT * FROM fixtures"; 
			$result1 = mysqli_query($conn, $sql1);
			if (mysqli_num_rows($result1) > 0){
				while($row = mysqli_fetch_assoc($result1)){
					echo "<option value='" . $row['fixture_id'] ."'>" . $row['team_name'] ."</option>";
				}
			}   
		?>
		</select><br>
		<label for="goals-scored">Goals</label> <input type="text" name="goals-scored" id="goals-scored"><br>
		<br><input type="submit" name="submit" value="submit">
	</form>
	
	
<?php	
	
	echo $error;
	echo $message;

?>

</body>

</html>
</html>