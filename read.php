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
                    $header .= '<th>update</th>';
                    $header .= '</tr>';
                    echo $header;
                }

                function setContent(array $data) {
                    $content = '';
                    foreach ($data as $row) {
                        $content .= '<tr>';

                        $id = $row['id'];
                        $name = $row['name'];
                        $difficulty = $row['difficulty'];
                        $distance = $row['distance'];
                        $duration = $row['duration'];
                        $height_difference = $row['height_difference'];

                        $content .= "<td>$id</td>";
                        $content .= "<td>$name</td>";
                        $content .= "<td>$difficulty</td>";
                        $content .= "<td>$distance</td>";
                        $content .= "<td>$duration</td>";
                        $content .= "<td>$height_difference</td>";

                        $url = "update.php?id=$id";
                        $content .= '<td><a href="'.$url.'">change</a></td>';
                        $content .= '</tr>';
                    }
                    echo $content;
                }

                try {
                    include 'database/connect.php';
                    $connexion = connectToDatabase();
                    $data = $connexion->query('SELECT * FROM '.getTableName())->fetchAll(PDO::FETCH_ASSOC);
                    echo '<table class="hiking">';
                    setHeader($data);
                    setContent($data);
                    echo '</table>';
                } catch(Exception $exception) {
                    echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
                }   
            ?>
        </table>
        <a href="create.php"><button type="button">Ajouter</button></a>
    </body>
</html>
