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
    if (isset($_POST['emailA']) && isset($_POST['passwordA'])) {
        // Escape special characters in username and password to prevent SQL injection attacks
        $email = mysqli_real_escape_string($dbhandle, $_POST['emailA']);
        $password = mysqli_real_escape_string($dbhandle, $_POST['passwordA']);

        // Query the database to check if the user exists
        $sql = "SELECT * FROM agent WHERE emailA='$email' AND passwordA='$password'";
        $result = mysqli_query($dbhandle, $sql);

        // If the query returns one row, then the user exists and we can start a session
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['emailA'] = $email;
            $_SESSION['passwordA'] = $password; 
            header('Location: espace agent.html');
            exit;
        } else {
            // If the query returns zero rows, then the user doesn't exist or the password is wrong
            echo "Invalid username or password.";
        }
    }
}
