<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }



require_once '../head.php';
require_once '../backend/conn.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>TakenLijst</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <a href="../index.php">Terug naar home</a>
    <?php if (isset($_GET['edit_success']) && $_GET['edit_success'] == 1): ?>
        <div class="success-message" style="max-width:600px;margin:20px auto;">Taak succesvol bijgewerkt!</div>
    <?php endif; ?>
    <?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
        <div class="error-message" style="max-width:600px;margin:20px auto;">Taak succesvol verwijderd!</div>
    <?php endif; ?>
    <div class="board-container">
        <h1 class="board-title">TakenLijst</h1>
        <a id="addTask" href="create.php" class="new-task-btn">+ Nieuwe Taak</a>
        <a href="done.php" style="margin-left:20px;">Bekijk afgeronde taken</a>
        <div class="board">
            <div class="column">
                <h2>To Do</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = 'todo'");
                $statement->execute();
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Progress</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = 'in progress'");
                $statement->execute();
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Review</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = 'review'");
                $statement->execute();
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Done</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = 'done'");
                $statement->execute();
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>