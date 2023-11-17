<?php
// Démarrez la session si ce n'est pas déjà fait
session_start();

// Récupérez l'email de l'utilisateur connecté
if (isset($_SESSION['emailR'])) {
    $email = $_SESSION['emailR'];

    // Connectez-vous à la base de données
    $username = "root";
    $password = "";
    $hostname = "localhost";
    
$database = "appsteg"; 
    $connexion = new mysqli($hostname, $username, $password, $database);

    if ($connexion->connect_error) {
        die("Connection failed: " . $connexion->connect_error);
    }

    // Mettez à jour la disponibilité à "non disponible" dans la base de données
    $updateSql = "UPDATE reparateur SET disponibilite='0' WHERE emailR='$email'";
    if ($connexion->query($updateSql) === TRUE) {
        // Détruisez toutes les variables de session
        session_unset();

        // Détruisez la session
        session_destroy();

        // Redirigez l'utilisateur vers la page de connexion ou une autre page de votre choix
        header("Location: index.html"); // Assurez-vous d'utiliser "Location: ..."
        exit();
    } else {
        echo "Failed to update availability: " . $connexion->error;
    }

    // Fermez la connexion à la base de données
    $connexion->close();
} else {
    // Redirigez l'utilisateur vers la page de connexion en cas de session non définie
    header("Location: index.html");
    exit();
}
?>

