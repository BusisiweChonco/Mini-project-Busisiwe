<?php 
	include("connect.php"); 
	$table = "";
	$error = "";
	$message = "";
	//Add fixture
	if(isset($_POST["submit"])){
		if(isset($_POST["fixture-date"]) || !empty($_POST["fixture-date"]) && (isset($_POST["fixture-time"]) || !empty($_POST["fixture-time"]))){
			try{
				$date = date_create($_POST["fixture-date"]);
			}catch(Exception $e){
				$error = "Please insert a valid date.";
			}
			if(count($error) === 0){
				if(strtolower($_POST["home-teamID"]) != strtolower($_POST["away-teamID"])){
					$sql = "INSERT INTO fixtures Value(NULL, '".$_POST["fixture-date"]."', '".$_POST["fixture-time"]."','".$_POST["home-teamID"]."','".$_POST["away-teamID"]."','".$_POST["competition-name"]."' )";
					//mysqli_query($mysqli,$sql);
					
					if (mysqli_query($conn, $sql)) {
						$message = "";
					} else {
						$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}else{
					$error = "A team can't play against itself.";
				}
			}
		}
	}else{
		$error = "Please ensure that date and time are inserted , teams and competition are selected.<br>";		
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
				$sql1 = null;
				$result1 = null;
				$sql1 = "SELECT * FROM teams";
				$result1 = mysqli_query($conn, $sql1);
				
				if(mysqli_num_rows($result1) > 0){
					while($row1 = mysqli_fetch_assoc($result1)){
						if($row["home_teamID"] == $row1["team_id"]){
							$home_team = $row1["team_name"];
						}
					}
				}
				$sql1 = null;
				$result1 = null;
				$sql1 = "SELECT * FROM teams";
				$result1 = mysqli_query($conn, $sql1);
				
				if(mysqli_num_rows($result1) > 0){
					while($row1 = mysqli_fetch_assoc($result1)){
						if($row["away_teamID"] == $row1["team_id"]){
							$away_team = $row1["team_name"];
						}
					}
				}
				$sql2 = "SELECT * FROM competitions";
				$result2 = mysqli_query($conn, $sql2);
				
				if(mysqli_num_rows($result2) > 0){
					while($row1 = mysqli_fetch_assoc($result2)){
						if($row["comp_id"] == $row1["comp_id"]){
							$comp_name = $row1["comp_name"];
						}
					}
				}
				$fixture = "$home_team vs $away_team";
				$table .= "<tr>";
				$table .= "<td>$fixture</td>";
				$table .= "<td>".$row["fixture_date"]."</td>";
				$table .= "<td>".$row["fixture_time"]."</td>";
				$table .= "<td>".$home_team."</td>";
				$table .= "<td>".$away_team."</td>";
				$table .= "<td>".$comp_name."</td>";
				$table .= "<td colspan='2'><a href='".$_SERVER['PHP_SELF']."?method=update&id=".$row['comp_id']."'>edit</a> | <a href='".$_SERVER['PHP_SELF']."?id=".$row["comp_id"]."&method=confirm-del' >delete</a></td>";
				
			}
		}else{
			$message = "There are no competitions!";
		}
		
		$table .= "</table><br><br><br>"; //Remove br lines
		
					
	}	
	
	echo $table;
	
	
	?>
	<form method="post" action="">
		<label>Add fixture</label><br>
		<label for="fixture-date">Date</label> <input type="date" name="fixture-date" id="fixture-date"><br>
		<label for="fixture-time">Time</label> <input type="time" name="fixture-time" id="fixture-time"><br>
		<label for="home-teamID">Select home team</label> 
		<select name="home-teamID" id="home-teamID">
		<?php	
			$sql1 = "SELECT * FROM teams"; 
			$result1 = mysqli_query($conn, $sql1);
			if (mysqli_num_rows($result1) > 0){
				while($row = mysqli_fetch_assoc($result1)){
					echo "<option value='" . $row['team_id'] ."'>" . $row['team_name'] ."</option>";
				}
			}
		?>
		</select><br>
		<label for="away-teamID">Select away team</label>
		<select name="away-teamID" id="away-teamID">
		<?php	
			$sql1 = null;
			$result1 = null;
			$sql1 = "SELECT * FROM teams"; 
			$result1 = mysqli_query($conn, $sql1);
			if (mysqli_num_rows($result1) > 0){
				while($row = mysqli_fetch_assoc($result1)){
					echo "<option value='" . $row['team_id'] ."'>" . $row['team_name'] ."</option>";
				}
			}
		?>
		</select><br>
		
		<label for="competition-name">Select competition</label>
		<select name="competition-name" id= "competition-name">
		<?php	
			
			$sql2 = "SELECT * FROM competitions"; 
			$result2 = mysqli_query($conn, $sql2);
			if (mysqli_num_rows($result2) > 0){
				while($row = mysqli_fetch_assoc($result2)){
					echo "<option value='" . $row['comp_id'] ."'>" . $row['comp_name'] ."</option>";
				}
			}
		?>
		</select>
		
		<br><input type="submit" name="submit" value="submit">
	</form>
	
	
<?php	
	
	echo $error;
	echo $message;

?>

</body>

</html>