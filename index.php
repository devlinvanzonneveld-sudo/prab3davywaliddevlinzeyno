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
<!doctype html>
<html lang="nl">

<head>
    <title>TakenLijst</title>
    <?php require_once 'head.php'; ?>
    <link rel="stylesheet" href="css/main.css">
</head>


<body>


    <div class="board-container">
        <h1 class="board-title">TakenLijst</h1>
        
        <a id="addTask" href="tasks/create.php" class="new-task-btn">+ Nieuwe Taak</a>
       

        <div class="board">
            <div class="column">
                <h2>to do</h2>
                <div id="todo-tasks"></div>
                <?php
                require_once 'backend/conn.php';
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = 'todo'");
                $statement->execute();
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>">
                        <a href = "tasks/details.php?id=<?= $task['id'] ?>"><?= $task['titel'] ?></a>
                        <p><?= $task['beschrijving'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="column">
                <h2>progress</h2>
                <div id="progress-tasks"></div>
            </div>

            <div class="column">
                <h2>review</h2>
                <div id="review-tasks"></div>
            </div>

            <div class="column">
                <h2>done</h2>
                <div id="done-tasks"></div>
            </div>
        </div>
    </div>

</body>

</html>
