<?php 
	include("connect.php");
	
	$error = "";
	$table = "";
	$message = "";
	$update_id = null;
	$update_form = null;

	if(isset($_POST["submit"]) && !isset($_GET["method"])){
		if(!isset($_POST["player-teamID"])){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(trim($_POST["player-teamID"]))  < 1){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["player-teamID"])) != strlen($_POST["player-teamID"])){
			$error .= "<p>It looks like some information is not in the correct format, please refresh the page.</p>";
		}
		
		if(!isset($_POST["player-name"])){
			$error .= "<p>Please insert player name.</p>";
		}else if(strlen(trim($_POST["player-name"]))  < 3){
			$error .= "<p>There is a limit on how short a player name can be. A player name should contain a minimum of 3 characters.<p>";
		}else if(strlen(preg_replace("/[^a-zA-Z ]/","",$_POST["player-name"])) != strlen($_POST["player-name"])){
			$error .= "<p>It looks like this player name contains characters that are not allowed. A player name can only contain alphabets and spaces.</p>";
		}
		
		if(!isset($_POST["shirt-number"])){
			$error .= "<p>It looks like the shirt number is missing, please insert shirt number.</p>";
		}else if(strlen(trim($_POST["shirt-number"]))  < 1){
			$error .= "<p>It looks like the shirt number is missing, please insert shirt number.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["shirt-number"])) != strlen($_POST["shirt-number"])){
			$error .= "<p>It looks like this player shirt number contains characters that are not allowed. A player number can only contain numbers.</p>";
		}
		
		if(!isset($_POST["position-descr"])){
			$error .= "<p>It looks like the player position is missing, please insert player position.</p>";
		}else if(strlen(trim($_POST["position-descr"]))  < 1){
			$error .= $error .= "<p>It looks like the player position is missing, please insert player position.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["position-descr"])) != strlen($_POST["position-descr"])){
			$error .= "<p>It looks like the player position is not in the correct format, please refresh the page.</p>";;
		}
		
		if(!strlen($error) > 0){
			$sql = "INSERT INTO players Value(NULL, '".$_POST["player-teamID"]."','".$_POST["player-name"]."','".$_POST["shirt-number"]."','".$_POST["position-descr"]."' )";
					
			if (mysqli_query($conn, $sql)) {
				$message = htmlspecialchars($_POST["player-name"])." was added.";
			} else {
				$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
			}			
		}

	}
	
	
	
	
	if(isset($_POST["btnUpdatePlayer"])){
		if(!isset($_POST["player-id"])){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(trim($_POST["player-teamID"]))  < 1){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["player-teamID"])) != strlen($_POST["player-teamID"])){
			$error .= "<p>It looks like some information is not in the correct format, please refresh the page.</p>";
		}else if(!isset($_POST["player-teamID"])){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(trim($_POST["player-teamID"]))  < 1){
			$error .= "<p>It looks like some information is missing, please refresh the page.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["player-teamID"])) != strlen($_POST["player-teamID"])){
			$error .= "<p>It looks like some information is not in the correct format, please refresh the page.</p>";
		}
		
		if(!isset($_POST["player-name"])){
			$error .= "<p>Please insert player name.</p>";
		}else if(strlen(trim($_POST["player-name"]))  < 3){
			$error .= "<p>There is a limit on how short a player name can be. A player name should contain a minimum of 3 characters.<p>";
		}else if(strlen(preg_replace("/[^a-zA-Z ]/","",$_POST["player-name"])) != strlen($_POST["player-name"])){
			$error .= "<p>It looks like this player name contains characters that are not allowed. A player name can only contain alphabets and spaces.</p>";
		}
		
		if(!isset($_POST["shirt-number"])){
			$error .= "<p>It looks like the shirt number is missing, please insert shirt number.</p>";
		}else if(strlen(trim($_POST["shirt-number"]))  < 1){
			$error .= "<p>It looks like the shirt number is missing, please insert shirt number.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["shirt-number"])) != strlen($_POST["shirt-number"])){
			$error .= "<p>It looks like this player shirt number contains characters that are not allowed. A player number can only contain numbers.</p>";
		}
		
		if(!isset($_POST["position-descr"])){
			$error .= "<p>It looks like the player position is missing, please insert player position.</p>";
		}else if(strlen(trim($_POST["position-descr"]))  < 1){
			$error .= $error .= "<p>It looks like the player position is missing, please insert player position.</p>";
		}else if(strlen(preg_replace("/[^0-9]/","",$_POST["position-descr"])) != strlen($_POST["position-descr"])){
			$error .= "<p>It looks like the player position is not in the correct format, please refresh the page.</p>";;
		}
		
		if(!strlen($error) > 0){
			$sql = "UPDATE players SET team_id = ".$_POST['player-teamID'].", player_name = '".$_POST['player-name']."',  	player_sqd_num = ".$_POST['shirt-number'].", position_id = ".$_POST["position-descr"]." WHERE player_id = ".$_POST['player-id']."";
					
			if (mysqli_query($conn, $sql)) {
				$message = htmlspecialchars($_POST["player-name"])." was updated.";
				header("Location: ".$_SERVER['PHP_SELF']);
			} else {
				$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
			}			
		}

	}

	if(isset($_GET["method"])){
		if(isset($_GET["id"]) && $_GET["method"] === "del"){
			$players_sql = "DELETE FROM players WHERE player_id = '".preg_replace("/[^0-9]/","",$_GET["id"])."' LIMIT 1";
			$players_query = mysqli_query($conn,$players_sql);
			
			
			if(mysqli_affected_rows($conn) == 1){
				$message = "The player was deleted.";
				header("Location: ".$_SERVER['PHP_SELF']);
				
			}else{
				$error = "Something went wrong, the player was not deleted.";
			}
		}
		if(isset($_GET["id"]) && $_GET["method"] === "update"){
			$update_id = preg_replace("/[^0-9]/","",$_GET["id"]);
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

	$players = [];
	$teams = [];
	$positions = [];

	if($table === ""){
		$players_sql = "SELECT * FROM players";
		$players_query = mysqli_query($conn, $players_sql);
		
		$teams_sql = "SELECT * FROM teams";
		$teams_query = mysqli_query($conn, $teams_sql);
		
		$player_position_sql = "SELECT * FROM playerposition";
		$player_position_query = mysqli_query($conn, $player_position_sql);
		
		if(!mysqli_num_rows($players_query) > 0){
			$message = "It looks like there are no players here.";
		}else if(!mysqli_num_rows($teams_query) > 0){
			$message = "It looks like there are no teams here, no player can possibly exist without a team.";
		}else if(!mysqli_num_rows($players_query) > 0){
			$message = "It looks like there are no player positions here, no player can possibly exist without a possition.";
		}else{
			while($player = mysqli_fetch_assoc($players_query)){
				$players[] = $player;
			}
			
			while($team = mysqli_fetch_assoc($teams_query)){
				$teams[] = $team;
			}
			
			while($position = mysqli_fetch_assoc($player_position_query)){
				$positions[] = $position;
			}
			
			for($player_index = 0; $player_index < count($players); $player_index++){
				for($team_index = 0; $team_index < count($teams); $team_index++){
					if($team_index === count($teams) - 1){
						if($players[$player_index]["team_id"] === $teams[$team_index]["team_id"]){
							$players[$player_index]["team_name"] = $teams[$team_index]["team_name"];
						}else{
							$players[$player_index]["team_name"] = "Warning: this player is not assigned to any team";
						}
					}else if($players[$player_index]["team_id"] === $teams[$team_index]["team_id"]){
						$players[$player_index]["team_name"] = $teams[$team_index]["team_name"];
						break;
					}
				}
				
				for($position_index = 0; $position_index < count($positions); $position_index++){
					if($position_index === count($positions) - 1){
						if($players[$player_index]["position_id"] === $positions[$position_index]["position_id"]){
							$players[$player_index]["position_descr"] = $positions[$position_index]["position_descr"];
						}else{
							$players[$player_index]["position_descr"] = "Warning: this player is not assigned to any position";
						}
					}else if($players[$player_index]["position_id"] === $positions[$position_index]["position_id"]){
						$players[$player_index]["position_descr"] = $positions[$position_index]["position_descr"];
						break;
					}
				}		
				
			}			
		}
		
		$table = 	"<table>	
						<tr>
							<th>Player</th>
							<th>Team</th>
							<th>Shirt number</th>
							<th>Position</th>
							<th colspan='2'>Actions</th>
						</tr>";
		
		foreach($players as $player){
			$table .= 	"<tr>
							<td>".$player["player_name"]."</td>
							<td>".$player["team_name"]."</td>
							<td>".$player["player_sqd_num"]."</td>
							<td>".$player["position_descr"]."</td>
							<td>
								<a href='".$_SERVER['PHP_SELF']."?id=".$player["player_id"]."&method=update' >edit</a>									
							</td>
							<td>
								<a href='".$_SERVER['PHP_SELF']."?id=".$player["player_id"]."&method=del' >delete</a>
							</td>
						</tr>";			
		}
		if($update_id != null){
			foreach($players as $player){
				if($player["player_id"] == $update_id){
					$update_form = 	"<form method='post' action=''>
										<h3>Update player</h3>
										<input type='hidden' name='player-id'  value='".$player["player_id"]."'>										
										<label>Surname Name</label>
										<input type='text' name='player-name' value='".$player['player_name']."'><br>
										<label for='player-teamID'>Team</label> 
										<select name='player-teamID'>";
			
					if(count($teams) > 0){
						$selected = null;
						foreach($teams as $team){
							$selected = $team['team_id'] === $player['team_id'] && $selected === null ? " selected":null;
							$update_form .= "<option value='" . $team['team_id'] ."' $selected>" . $team['team_name'] ."</option>";
						}				
					}

					$update_form .= 	"</select><br>
										<label for='shirt-number'>Shirt number</label> <input type='text' name='shirt-number' value='".$player['player_sqd_num']."'><br>
										<label>Player Position</label>
										<table>";
										
					if(count($positions) > 0){
						$checked = null;
						foreach($positions as $position){
							$checked = $position["position_id"] === $player['position_id'] && $checked === null ? " checked":null;
							$update_form .=		"<tr>
													<td>
														<input type='radio' name='position-descr' value = '".$position['position_id']."'$checked> ".$position['position_descr']."
													</td>
												</tr>";
						}
					}
					
					$update_form .=		"</table><br>
										<input type='submit' name='btnUpdatePlayer' value='Update player'>
									</form>";
					break;
				}
			}
		}
		
		$table .= "</table>";
			
			
	}	
	echo $update_id === null ? $table : $update_form;	
	if($update_id === null){
	?>
	
	<form method="post" action="">
		<h3>Add player</h3>
		<label for="player-name">Surname Name</label> <input type="text" name="player-name" id="player-name"><br>
		<label for="player-teamID">Team</label> 
		<select name="player-teamID" id="player-teamID">
		<?php	
			if(count($teams > 0)){
				foreach($teams as $team){
					echo "<option value='" . $team['team_id'] ."'>" . $team['team_name'] ."</option>";
				}				
			}

		?>
		</select><br>
		<label for="shirt-number">Shirt number</label> <input type="text" name="shirt-number" id="shirt-number"><br>
		<label>Player Position</label>
		<?php
			$pos_table = "<table>";
			if(count($positions) > 0){
				foreach($positions as $position){
					$pos_table .= 	"<tr>
										<td>
											<input type='radio' name='position-descr' value = '".$position['position_id']."';> ".$position['position_descr']."
										</td>
									</tr>";
				}
			}
			
			$pos_table .= "</table>";
			
			echo $pos_table;
		?>
		<br><input type="submit" name="submit" value="submit">
	</form>
	
	
<?php	
	
	echo $error;
	echo $message;
	}

?>

</body>

</html>