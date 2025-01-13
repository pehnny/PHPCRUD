<?php
	try {
		include 'database/connect.php';
		$connexion = connectToDatabase();
		updateHike($connexion);
	} catch(Exception $exception) {
		echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
	}

	function updateHike(PDO $connexion) {
		if (!isset($_GET['id']) || !isset($_GET['name']) || !isset($_GET['difficulty']) || !isset($_GET['distance']) || !isset($_GET['duration']) || !isset($_GET['height_difference'])) {
			return;
		}
		// ['name' => $name, 'difficulty' => $difficulty, 'distance' => $distance, 'duration' => $duration, 'height_difference' => $height_difference] = $_GET;
		// $connexion->query("INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES ('$name', '$difficulty', '$distance', '$duration', '$height_difference')");
		// echo '<p style="color:green;">Nouvelle randonée créée avec succès !</p>';
	}
?>

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
			<input type="text" name="name" value="<?php echo $_GET['name'];?>"/>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<?php 
				$difficulties = array('très facile', 'facile', 'moyen', 'difficile', 'très difficile');
				$selected = $_GET['difficulty'];

				foreach ($difficulties as $difficulty) {
					if ($difficulty == $selected) {
						$options .= "<option value=".$difficulty." selected>".ucfirst($difficulty)."</option>";
						continue;
					}
					$options .= "<option value=".$difficulty.">".ucfirst($difficulty)."</option>";
				}
				echo $options
				?>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $_GET['distance'];?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $_GET['duration'];?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $_GET['height_difference'];?>">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>