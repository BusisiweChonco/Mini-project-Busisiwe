<?php 
	include("connect.php"); 
	$table = "";
	$error = "";
	$message = "";
	//Add Competition
	if(isset($_POST["submit"])){
		if(isset($_POST["competition-name"]) && !empty($_POST["competition-name"])){
			$sql = "INSERT INTO competitions Value(NULL, '".$_POST["competition-name"]."')";
			//mysqli_query($mysqli,$sql);
			
			if (mysqli_query($conn, $sql)) {
				$message = "New record created successfully";
			} else {
				$error = "Error: <br>" . mysqli_error($conn);
			}
			
		}else{
			$error = "Please insert a competition name.<br>";		
		}
	}
	//Update Competition
	if(isset($_GET['method']) && !empty($_GET['method'])){
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			$id = preg_replace("/[^0-9]/","",$_GET["id"]);

			if($_GET['method'] === "update"){
				$query = "SELECT * FROM competitions WHERE comp_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<form method='post' action=''>";
				$table .= "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Competition</th>";
				$table .= "<th>Action</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$table .= "<tr>";
						
						$table .= "<td><input name='update-name' type='text' value='".$row["comp_name"]."'><input name='id' type='hidden' value='".$row["comp_id"]."'></td>";
						$table .= "<td><input name='continue-update' type='submit' value='Done'></td>";
					}
				}
				$table .= "</table></form><br><br><br>"; //Remove br lines		
			}else if($_GET['method'] === "del"){
				$query = "DELETE FROM competitions WHERE comp_id = '$id'";
				$result = mysqli_query($conn,$query);
				$table = "";
			}
		}
	}
	if(isset($_POST['continue-update'])){
		if(isset($_POST["id"]) && !empty($_POST["id"]) && !empty($_POST["update-name"])){
			$id = preg_replace("/[^0-9]/","",$_POST["id"]);
			$query = "UPDATE competitions SET comp_name = '".$_POST['update-name']."' WHERE comp_id = '$id'";
			$result = mysqli_query($conn,$query);
			$table = "";
		}	
	}

	//Delete Competition
	if(isset($_GET['method']) && !empty($_GET['method'])){
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			$id = preg_replace("/[^0-9]/","",$_GET["id"]);

			if($_GET['method'] === "confirm-del"){
				$query = "SELECT * FROM competitions WHERE comp_id = '$id'";
				$result = mysqli_query($conn, $query);
				$table = "<table>";	
				$table .=  "<tr>";
				$table .= "<th>Competition</th>";
				$table .= "<th>Action</th>";
				$table .= "</tr>";
				
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
							$table .= "<tr>";
							$table .= "<td>".$row["comp_name"]."</td>";
							$table .= "<td colspan='4'>Do you want to delete ".$row['comp_name']." <a href='".$_SERVER['PHP_SELF']."?id=".$id."&method=del'>Yes</a> | <a href='".$_SERVER['PHP_SELF']."'>No</a></td>";
					}
				}
				$table .= "</table><br><br><br>"; //Remove br lines		
			}else if($_GET['method'] === "del"){
				$query = "DELETE FROM competitions WHERE comp_id = '$id'";
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
		$query = "SELECT * FROM competitions";
		$result = mysqli_query($conn, $query);
		$table = "<table>";	
		$table .=  "<tr>";
		$table .= "<th>Competition</th>";
		$table .= "<th>Action</th>";
		$table .= "</tr>";
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$table .= "<tr>";
				$table .= "<td>".$row["comp_name"]."</td>";
				$table .= "<td colspan='2'><a href='".$_SERVER['PHP_SELF']."?method=update&id=".$row['comp_id']."'>edit</a> | <a href='".$_SERVER['PHP_SELF']."?id=".$row["comp_id"]."&method=confirm-del' >delete</a></td>";
				
			}
		}else{
			$message = "There are no competetions!";
		}
		
	
		$table .= "</table><br><br><br>"; //Remove br lines
		$table .=	'<form method="post" action="">
						<label for="competition-name">Add competition</label> <input type="text" name="competition-name" id="competition-name"><br>
						<input type="submit" name="submit" value="submit">
					</form>';		
	}	
	
	echo $table;
	echo $error;
	echo $message;

?>



</body>

</html>