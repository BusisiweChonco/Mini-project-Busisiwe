<?php
include("connect.php"); 
$table = "";
$error = "";
$message = "";

//Add a team
	if(isset($_POST["submit"])){
		if(isset($_POST["position-descr"]) && !empty($_POST["position-descr"])){
			$positionID = rand(0,14);
			while($positionID == 0){
				$positionID = rand(0,14);
			}
			$track = true;
			//Check if description exist
			$sql = null;
			$sql = "SELECT * FROM playerposition WHERE position_descr='".$_POST["position-descr"]."'";
			$checkDescr = mysqli_query($conn, $sql);
			if(mysqli_num_rows($checkDescr) > 0){
				$message = "Position already exist";
				$track = false;
			}else{
				while(true){
					$sql = null;
					$checkID = null;
					$sql = "SELECT * FROM playerposition WHERE position_id = '$positionID'";
					$checkID = mysqli_query($conn, $sql);
					
					if(mysqli_num_rows($checkID) == 14){
						$message = "1 Position already exist";
						break;
					}else if(mysqli_num_rows($checkID) > 0){
						$positionID = rand(0,14);
						while($positionID == 0){
							$positionID = rand(0,14);
						}
					}
					else{
						$sql = null;
						$sql = "INSERT INTO playerposition Value('$positionID', '".$_POST["position-descr"]."')";
			
						if (mysqli_query($conn, $sql)) {
							$track = false;
							
							$message = $positionID." 2 New position added successfully";
							header("Location: player_position.php");
						} else {
							$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						break;
					}
				}
			}
			
			
			if($track){
				//Check if ID exist, if not Check if Position exist
				$count = 0;
				$sql = "SELECT * FROM playerposition WHERE position_id = '$positionID'";
				$checkID = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($checkID) > 0){
					while($row = mysqli_fetch_assoc($checkID)){
						$count = $count + 1;
					}
					if($count == 14){
						$message = "All positions occupied";
					}else{
						//Check if description exist
						$sql = null;
						$sql = "SELECT * FROM playerposition WHERE position_descr='".$_POST["position-descr"]."'";
						$checkDescr = mysqli_query($conn, $sql);
						if(mysqli_num_rows($checkDescr) > 0){
							$message = "Position already exist";
						}else{
							$sql = "INSERT INTO playerposition Value('$positionID', '".$_POST["position-descr"]."')";
				
							if (mysqli_query($conn, $sql)) {
								$message = "New team added successfully";
								header("Location: player_position.php");
							} else {
								$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
						}
					}
				}else{
					$sql = "INSERT INTO playerposition Value('$positionID', '".$_POST["position-descr"]."')";
				
					if (mysqli_query($conn, $sql)) {
						$message = "New team added successfully";
					} else {
						$error = "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}
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
				$query = "SELECT * FROM playerposition WHERE position_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<form method='post' action=''>";
				$table .= "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Team</th>";
				$table .= "<th>Actions</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$table .= "<tr>";
						$table .= "<td><input name='update-position' type='text' value='".$row["position_descr"]."'><input name='id' type='hidden' value='".$row["position_id"]."'></td>";
						$table .= "<td><input name='continue-update' type='submit' value='Done'></td>";
							}
						}
						$table .= "</table></form><br><br><br>"; //Remove br lines		
				}else if($_GET['method'] === "del"){
					$query = "DELETE FROM playerposition WHERE position_id = '$id'";
					$result = mysqli_query($conn,$query);
					$table = "";
				}
			}
		}
	if(isset($_POST['continue-update'])){
		if(isset($_POST["id"]) && !empty($_POST["id"]) && !empty($_POST["update-position"])){
			$id = preg_replace("/[^0-9]/","",$_POST["id"]);
			$query = "UPDATE playerposition SET position_descr = '".$_POST['update-position']."' WHERE position_id = '$id'";
			$result = mysqli_query($conn,$query);
			$table = "";
		}	
	}
	
	
//Delete teams
		if(isset($_GET['method']) && !empty($_GET['method'])){
			if(isset($_GET["id"]) && !empty($_GET["id"])){
				$id = preg_replace("/[^0-9]/","",$_GET["id"]);
				
				if($_GET['method'] === "confirm-del"){
					$query = "SELECT * FROM playerposition WHERE position_id = '$id'";
					$result = mysqli_query($conn, $query);
					$table = "<table>";	
					$table .=  "<tr>";
					$table .= "<th>Player_Position</th>";
					$table .= "<th>Actions</th>";
					$table .= "</tr>";
					
					if (mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
								$table .= "<tr>";
								$table .= "<td>".$row["position_descr"]."</td>";
								$table .= "<td colspan='4'>Do you want to delete ".$row['position_descr']." <a href='".$_SERVER['PHP_SELF']."?id=".$id."&method=del'>Yes</a> | <a href='".$_SERVER['PHP_SELF']."'>No</a></td>";
						}
					}
					$table .= "</table><br><br><br>"; //Remove br lines		
				}else if($_GET['method'] === "del"){
					$query = "DELETE FROM playerposition WHERE position_id = '$id'";
					$result = mysqli_query($conn,$query);
					// Commit transaction
					mysqli_commit($conn);
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
		$query = "SELECT * FROM playerposition";
		$result = mysqli_query($conn, $query);
		$table = "<table>";	
		$table .=  "<tr>";
		$table .= "<th>Player_Position</th>";
		$table .= "<th>Action</th>";
		$table .= "</tr>";
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$table .= "<tr>";
				$table .= "<td>".$row["position_descr"]."</td>";
				
				$table .= "<td colspan='2'><a href='".$_SERVER['PHP_SELF']."?method=update&id=".$row['position_id']."'>edit</a> | <a href='".$_SERVER['PHP_SELF']."?id=".$row["position_id"]."&method=confirm-del' >delete</a></td>";
				
			}
		}else{
			$message = "There are no positions";
		}
		
	
		$table .= "</table><br><br><br>"; //Remove br lines
		$table .=	'<form method="post" action="">
						<label for="position-descr">Add player position</label> <input type="text" name="position-descr" id="position-descr"><br>
						<input type="submit" name="submit" value="submit">
					</form>';			
	}	
	
	echo $table;
	echo $error;
	echo $message;

?>



</body>

</html>