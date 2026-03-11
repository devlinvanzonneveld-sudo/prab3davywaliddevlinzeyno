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
        
        <button id="addTask" class="new-task-btn">+ Nieuwe Taak</button>

        <div class="board">
            <div class="column">
                <h2>to do</h2>
                <div id="todo-tasks"></div>
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
