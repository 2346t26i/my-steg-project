<!DOCTYPE html>
<html>
<head>
    <title>Liste des réclamations</title>
    <link rel="stylesheet" href="css/drp.css">
</head>
<body>
    <h1>Liste des réclamations</h1>

    <table border="1">
        <tr>
            <th>ID Panne</th>
            <th>Nature de la Panne</th>
            <th>Date de la Panne</th>
            <th>Numéro de Série</th>
            <th>Type de Matériel</th>
            <th>Modèle</th>
            <th>Description du Problème</th>
        </tr>

        <?php
        //connexion avec le serveur (APACHE)
        $username = "root";
        $password = "";
        $hostname = "localhost";
        // activer le rapport d'erreur
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // connection string with database
        $dbhandle = mysqli_connect($hostname, $username, $password);
        if (!$dbhandle) {
            die("Connection failed: " . mysqli_connect_error());
        } // pour verifier si $dbhandle est null
        // connect with table
        $selected = mysqli_select_db($dbhandle, "appsteg");

        $sql = "SELECT * FROM reclamations";
        $result = mysqli_query($dbhandle, $sql);

        // If the query returns data, display it
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["idpanne"] . "</td>";
                echo "<td>" . $row["nature_panne"] . "</td>";
                echo "<td>" . $row["date_panne"] . "</td>";
                echo "<td>" . $row["num_serie"] . "</td>";
                echo "<td>" . $row["type_materiel"] . "</td>";
                echo "<td>" . $row["modele"] . "</td>";
                echo "<td>" . $row["description_probleme"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Aucune réclamation trouvée.";
        }

        mysqli_close($dbhandle);
        ?>
    </table>
</body>
</html>