<?php
    header('Location: http://localhost:5000/read.php');

    try {
        include 'database/connect.php';
        $connexion = connectToDatabase();
        $query = $connexion->query('DELETE FROM '.getTableName()." WHERE id = '{$_GET['id']}'");
        exit(0);
    } catch(PDOException $exception) {
        exit(1);
    }
?>
