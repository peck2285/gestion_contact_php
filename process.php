<?php
// Démarrer la session
session_start();


// Vérification des données du formulaire
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);

    // Validation du nom avec une expression régulière
    if (!preg_match("/^[a-zA-Z ]{2,}$/", $name)) {
        $errors[] = "Le nom doit contenir au moins 2 caractères et peut inclure seulement des lettres et des espaces";
    }

    // Validation de l'e-mail avec une expression régulière
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'e-mail n'est pas valide";
    }

    // Validation du numéro de téléphone avec une expression régulière
    if (!preg_match("/^[0-9]{1,}$/", $phone)) {
        $errors[] = "Le numéro de téléphone doit contenir seulement des chiffres";
    }

    // Si aucune erreur, ajouter le contact à la liste (dans la session)
    if (empty($errors)) {
        $contact = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        );

        // Si la clé 'contacts' n'existe pas dans la session, la créer
        if (!isset($_SESSION['contacts'])) {
            $_SESSION['contacts'] = array();
        }

        // Ajouter le contact à la session
        $_SESSION['contacts'][] = $contact;
    }
}

// Fonction pour nettoyer et valider les données du formulaire
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Redirection vers la page principale avec les erreurs (le cas échéant)
if (!empty($errors)) {
    header("Location: index.html?errors=" . urlencode(implode(",", $errors)));
} else {
    header("Location: index.html");
}
?>
