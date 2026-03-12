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
