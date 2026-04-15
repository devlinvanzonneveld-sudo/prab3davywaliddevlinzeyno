    <?php
    session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: login.php?msg=$msg");
        exit;
    }
?>
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
        <?php if (isset($_GET['msg'])): ?>
            <div class="success-message" style="color: green; font-weight: bold; margin-bottom: 20px;">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>
        <p>Beheer eenvoudig alle taken van het park.</p>
        <a href="tasks/index.php" style="font-size:1.2em; padding:10px 20px; background:#0078d4; color:#fff; border-radius:5px; text-decoration:none;">Ga naar takenoverzicht</a>
    </div>
</body>
</html>