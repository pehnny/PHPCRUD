<?php
	function updateHike(PDO $connexion) {
		if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['difficulty']) || !isset($_POST['distance']) || !isset($_POST['duration']) || !isset($_POST['height_difference'])) {			
			return;
		}

		['id' => $id, 'name' => $name, 'difficulty' => $difficulty, 'distance' => $distance, 'duration' => $duration, 'height_difference' => $height_difference] = $_POST;
		$connexion->query('UPDATE '.getTableName()." SET name = '$name', difficulty = '$difficulty', distance = '$distance', duration = '$duration', height_difference = '$height_difference' WHERE id = '$id'");
		echo '<p style="color:green;">Randonnée mise à jour avec succès !</p>';
	}

	try {
		include 'database/connect.php';
		$connexion = connectToDatabase();
	} catch(PDOException $exception) {
		die('<p style="color:red;">' . $exception->getMessage() . '</p>');
	}

	try {
		updateHike($connexion);
	} catch(Exception $exception) {
		echo '<p style="color:red;">'.$exception->getMessage().'</p>';
	}

	try {
		$query = $connexion->query("SELECT * FROM hiking WHERE id = '{$_GET['id']}'");
		$hike = $query->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $exception) {
		die('<p style="color:red;">'.$exception->getMessage().'</p>');
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
			<input type="text" name="name" value="<?php echo $hike['name'];?>" required/>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" required>
				<?php 
					$difficulties = array('très facile', 'facile', 'moyen', 'difficile', 'très difficile');
					$selected = $hike['difficulty'];

					foreach ($difficulties as $difficulty) {
						if ($difficulty == $selected) {
							$options .= "<option value='$difficulty' selected>".ucfirst($difficulty)."</option>";
							continue;
						}
						$options .= "<option value='$difficulty'>".ucfirst($difficulty)."</option>";
					}
					echo $options
				?>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $hike['distance'];?>" required/>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $hike['duration'];?>" required/>
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $hike['height_difference'];?>" required/>
		</div>
		<input type="hidden" name="id" value="<?php echo $hike['id'];?>">
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
