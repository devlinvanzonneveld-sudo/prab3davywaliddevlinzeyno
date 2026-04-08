<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }


require_once '../backend/conn.php';

$sql = "SELECT titel, afdeling FROM taken WHERE status = 'done'";


$stmt = $conn->prepare($sql);


$stmt->execute();


$taken = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klaar - Takenlijst</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="done-container">
        <div class="done-header">
            <h1>Afgeronde taken</h1>
            <a href="index.php">Terug naar overzicht</a>
        </div>

        <?php if (count($taken) > 0): ?>
            <table class="done-table">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Afdeling</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taken as $taak): ?>
                        <tr>
                            <td><?= htmlspecialchars($taak['titel']) ?></td>
                            <td><?= htmlspecialchars($taak['afdeling']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-tasks">
                <p>Er zijn nog geen afgeronde taken.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
