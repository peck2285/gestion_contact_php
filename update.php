<?php
// Fonction pour nettoyer et valider les données du formulaire
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $contactId = $_GET['id'];

    if (isset($_SESSION['contacts'][$contactId])) {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $phone = test_input($_POST["phone"]);

        // Validation des données mises à jour
        if (!empty($name) && !empty($email) && !empty($phone)) {
            $_SESSION['contacts'][$contactId]['name'] = $name;
            $_SESSION['contacts'][$contactId]['email'] = $email;
            $_SESSION['contacts'][$contactId]['phone'] = $phone;
        }
    }   
}

// Redirige vers la page principale après la modification
header("Location: index.html");
?>
