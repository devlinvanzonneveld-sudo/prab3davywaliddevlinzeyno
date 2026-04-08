

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pretpark Takenlijst - Home</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div style="text-align:center; margin-top:60px;">
        <img src="img/logo.png" alt="Pretpark Logo" style="max-width:200px;">
        <h1>Welkom bij het Pretpark Takenbord</h1>
        <p>Beheer eenvoudig alle taken van het park.</p>
        <a href="tasks/index.php" style="font-size:1.2em; padding:10px 20px; background:#0078d4; color:#fff; border-radius:5px; text-decoration:none;">Ga naar takenoverzicht</a>
    </div>
</body>
</html>
<!doctype html>
<html lang="nl">

<head>
    <title>TakenLijst</title>
    <?php require_once 'head.php'; ?>
    <link rel="stylesheet" href="css/main.css">
</head>


<body>

    <div class="board-container">
       <form action="app/Http/Controllers/InlogController.php" method="POST">
             <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">




            <input type="submit">

       </form>
    </div>

</body>

</html>
