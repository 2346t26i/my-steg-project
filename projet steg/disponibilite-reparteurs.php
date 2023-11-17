<?php
// Connexion à la base de données
$username = "root";
$password = "";
$hostname = "localhost";

// Activer le rapport d'erreur
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connection à la base de données
$dbhandle = mysqli_connect($hostname, $username, $password);

// Vérifier la connexion
if (!$dbhandle) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

// Sélectionner la base de données
$selected = mysqli_select_db($dbhandle, "appsteg");

if (!$selected) {
    die("Sélection de la base de données a échoué: " . mysqli_error($dbhandle));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilité reparateurs</title>
    <link rel="stylesheet" href="css/drp.css">
</head>
<body>
  
     <section id="disponibilite-reparateurs">
            <h2>Disponibilité des Réparateurs</h2>
            <table>
                <thead>
                    <tr>
                        <th>id de Réparateur</th>
                        <th>Disponibilité</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Requête SQL pour récupérer les valeurs de idR et disponibilité
                    $sql = "SELECT idR, disponibilite FROM reparateur";

                    $result = mysqli_query($dbhandle, $sql);

                    // Vérification des résultats
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['idR'] . "</td>";
                            echo "<td>" . $row['disponibilite'] . "</td>";
                            echo "<td><button class='affecter-btn' data-href='affecter_tache.html' data-id='{$row['idR']}'>Affecter</button></td>";





                            echo "</tr>";
                        }
                    } else {
                        echo "Aucun résultat trouvé dans la table.";
                    }

                    // Fermeture de la connexion à la base de données
                    mysqli_close($dbhandle);
                    ?>
                </tbody>
            </table>
     </section>
     <script>
        // Récupérer tous les boutons "Affecter" par leur classe
        var affecterBtns = document.querySelectorAll('.affecter-btn');

        // Ajouter un gestionnaire de clic à chaque bouton
        affecterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Récupérer l'ID du réparateur à partir de l'attribut data-id
                var idReparateur = btn.getAttribute('data-id');
                
                // Rediriger l'utilisateur vers la page "affecter_tache.html" avec l'ID du réparateur en tant que paramètre d'URL
                window.location.href = 'affecter_tache.html?idR=' + idReparateur;
            });
        });
    </script>
        
        <!-- ... (autres sections similaires) ... -->
   
</body>
<footer>
    <p>&copy; 2023 Société Tunisienne d'Électricité et du gaz</p>
</footer>
</html>