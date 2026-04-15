<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }

$current_user_id = $_SESSION['user_id'];

require_once '../head.php';
require_once '../backend/conn.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Taken - Takenlijst</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div style="margin-bottom:20px;">
        <a href="../index.php" style="padding:8px 12px; background:#0078d4; color:white; text-decoration:none; border-radius:3px; margin-right:10px;">Terug naar home</a>
        <a href="index.php" style="padding:8px 12px; background:#107c10; color:white; text-decoration:none; border-radius:3px;">Alle Taken</a>
    </div>
    <?php if (isset($_GET['edit_success']) && $_GET['edit_success'] == 1): ?>
        <div class="success-message" style="max-width:600px;margin:20px auto;">Taak succesvol bijgewerkt!</div>
    <?php endif; ?>
    <?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
        <div class="error-message" style="max-width:600px;margin:20px auto;">Taak succesvol verwijderd!</div>
    <?php endif; ?>
    <div class="board-container">
        <h1 class="board-title">Mijn Taken</h1>
        <a id="addTask" href="create.php" class="new-task-btn">+ Nieuwe Taak</a>
        <div class="board">
            <div class="column">
                <h2>To Do</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'todo',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <p style="margin:5px 0 0 0; font-size:0.9em; color:#666;"><strong>Afdeling:</strong> <?= htmlspecialchars($task['afdeling']) ?></p>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                        <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Progress</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'in progress',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <p style="margin:5px 0 0 0; font-size:0.9em; color:#666;"><strong>Afdeling:</strong> <?= htmlspecialchars($task['afdeling']) ?></p>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                        <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Review</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'review',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <p style="margin:5px 0 0 0; font-size:0.9em; color:#666;"><strong>Afdeling:</strong> <?= htmlspecialchars($task['afdeling']) ?></p>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                        <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h2>Done</h2>
                <?php
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'done',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
                        <p style="margin:5px 0 0 0; font-size:0.9em; color:#666;"><strong>Afdeling:</strong> <?= htmlspecialchars($task['afdeling']) ?></p>
                        <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');" style="position:absolute; top:8px; right:8px;">
                            <img src="../img/delete.png" alt="Verwijder" style="width:18px; height:18px; vertical-align:middle; opacity:0.7;">
                        </a>
                        <p><?= $task['beschrijving'] ?></p>
                        <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
