    <?php
    session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe taak toevoegen</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
 
    <div class="container">
        <img src="../img/logo.png" alt="Pretpark Logo">
        <h1>Nieuwe taak toevoegen</h1>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">Taak succesvol toegevoegd!</div>
        <?php endif; ?>
        <form action="../app/Http/Controllers/tasksController.php" method="POST">
            <input type="hidden" name="action" value="create">
            <div class="form-group">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="afdeling">Afdeling:</label>
                <select name="afdeling" id="afdeling" class="form-input" required>
                    <option value="">-- Kies afdeling --</option>
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                </select>
            </div>
            <button type="submit">Toevoegen</button>
        </form>
        <br>
        <a href="index.php">Terug naar overzicht</a>
    </div>
</body>
</html>