<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php"><button type="button">Retour à la liste</button></a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="" required/> 
		</div>
		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" required>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="" required>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="" required>
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="" required>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>

<?php
	function setHike(PDO $connexion) {
		['name' => $name, 'difficulty' => $difficulty, 'distance' => $distance, 'duration' => $duration, 'height_difference' => $height_difference] = $_POST;
		$connexion->query("INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES ('$name', '$difficulty', '$distance', '$duration', '$height_difference')");
		echo '<p style="color:green;">Nouvelle randonée créée avec succès !</p>';
	}
	
	if (!isset($_POST['name']) || !isset($_POST['difficulty']) || !isset($_POST['distance']) || !isset($_POST['duration']) || !isset($_POST['height_difference'])) {
		die();
	}

	try {
		include 'database/connect.php';
		$connexion = connectToDatabase();
		setHike($connexion);
	} catch(Exception $exception) {
		echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
	}
?>