<?php
session_start();

if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    if (isset($_SESSION['contacts'][$contactId])) {
        $contact = $_SESSION['contacts'][$contactId];

        // Affiche le formulaire de modification avec les données actuelles du contact
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier un contact</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h2>Modifier un contact</h2>
            <form action="update.php?id=<?php echo $contactId; ?>" method="post">
                <label for="name">Nom :</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
                <br>
                <label for="email">E-mail :</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
                <br>
                <label for="phone">Numéro de téléphone :</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
                <br>
                <input type="submit" value="Enregistrer les modifications">
            </form>
        </body>
        </html>
        <?php
    } else {
        // Redirige vers la page principale si l'ID du contact n'est pas valide
        header("Location: index.html");
    }
} else {
    // Redirige vers la page principale si l'ID du contact n'est pas spécifié
    header("Location: index.html");
}
?>
