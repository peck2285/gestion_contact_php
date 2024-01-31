<?php
session_start();

if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    if (isset($_SESSION['contacts'][$contactId])) {
        // Supprime le contact avec l'ID spécifié
        unset($_SESSION['contacts'][$contactId]);
    }
}

// Redirige vers la page principale après la suppression
header("Location: index.html");
?>
