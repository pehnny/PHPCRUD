<?php
    // Change these 4 functions to match you local user and database
    function getHost(): string {
        return 'localhost';
    }

    function getDBName(): string {
        return 'becode';
    }

    function getUser(): string {
        return 'root';
    }

    function getPassword(): string {
        return '';
    }

    function getTableName(): string {
        return 'hiking';
    }

    function connectToDatabase(): PDO {
        try {
            $connexion = new PDO('mysql:host='.getHost().';dbname='.getDBName().';charset=utf8', getUser(), getPassword());
            return $connexion;
        } catch(PDOException $exception) {
            echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
            die();
        }
    }
?>
