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
} //pour verifier si $dbhandle est null
// connect with table
$selected = mysqli_select_db($dbhandle, "appsteg");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le email d'utilisateur et le password sont définis
    if (isset($_POST['emailRs']) && isset($_POST['passwordRs'])) {
        // Escape special characters in username and password to prevent SQL injection attacks
        $email = mysqli_real_escape_string($dbhandle, $_POST['emailRs']);
        $password = mysqli_real_escape_string($dbhandle, $_POST['passwordRs']);

        // Query the database to check if the user exists
        $sql = "SELECT * FROM responsable WHERE emailRs='$email' AND passwordRs='$password'";
        $result = mysqli_query($dbhandle, $sql);

        // If the query returns one row, then the user exists and we can start a session
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['emailRs'] = $email;
            $_SESSION['passwordRs'] = $password; 
            header('Location: espace-responsable.html');
            exit;
        } else {
            // If the query returns zero rows, then the user doesn't exist or the password is wrong
            echo "Invalid username or password.";
        }
    }
}