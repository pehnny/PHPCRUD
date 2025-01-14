<?php
    try {
        include 'database/connect.php';
        $connexion = connectToDatabase();
        $query = $connexion->query('SELECT * FROM '.getTableName());
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        die('<p style="color:red;">'.$exception->getMessage().'</p>');
    }   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Randonnées</title>
        <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <h1>Liste des randonnées</h1>
            <?php
                function setHeader(array $data) {
                    $header = '<tr>';
                    foreach (array_keys($data[0]) as $title) {
                        $header .= "<th>$title</th>";
                    }
                    $header .= <<<END
                        <th>update</th>
                        <th>delete</th>
                    END;
                    $header .= '</tr>';
                    echo $header;
                }

                function setData(array $data) {
                    $content = '';
                    foreach ($data as $row) {
                        $updateURL = "update.php?id={$row['id']}";
                        $deleteURL = "delete.php?id={$row['id']}";
                        $content .= '<tr>';
                        foreach ($row as $element) {
                            $content .= "<td>$element</td>";
                        }
                        $content .= <<<END
                            <td><a href="$updateURL">change</a></td>
                            <td><a href="$deleteURL">X</a></td>
                        END;
                        $content .= '</tr>';
                    }
                    echo $content;
                }

                try {
                    echo '<table class="hiking">';
                    setHeader($data);
                    setData($data);
                    echo '</table>';
                } catch(Exception $exception) {
                    echo '<p style="color:red;">'.$exception->getMessage().'</p>';
                }   
            ?>
        </table>
        <a href="create.php"><button type="button">Ajouter</button></a>
    </body>
</html>
