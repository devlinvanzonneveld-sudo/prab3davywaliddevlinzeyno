<?php
/*
 * LEERLINGOPDRACHT: Mijn Taken Pagina
 * 
 * Deze pagina toont ALLEEN de taken die de huidige ingelogde gebruiker heeft gemaakt.
 * Vergelijk dit met afdeling.php - het is erg vergelijkbaar, maar in plaats van 
 * filteren op afdeling via $_GET, filteren we op user_id via $_SESSION
 */

session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }

// Haal het user ID van de ingelogde gebruiker uit de sessie
// HINT: Je hebt dit al in de controller wanneer je taken aanmaakt. Waar werd het opgeslagen?
$current_user_id = $_SESSION['user_id'];  // TODO: Zorg dat dit correct is

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
    <a href="../index.php">Terug naar home</a>
    <a href="index.php" style="margin-left:20px;">Bekijk alle taken</a>
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
                
                
                
         
                /*
                 * OPDRACHTDEEL 1:
                 * Schrijf een SELECT query die alle taken ophaalt WHERE:
                 * 1. De status is gelijk aan 'todo' 
                 * 2. De user kolom is gelijk aan het huidige user ID
                 * 3. Sorteer op deadline (oplopend, eerst de vroegste)
                 * 
                 * HINT: Je hebt TWEE voorwaarden nodig in je WHERE clause.
                 * Gebruik AND om ze te combineren.
                 * Kijk in tasksController.php hoe de user in de database wordt opgeslagen.
                 */
                
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    // HINT: Welke parameters moet je hier binden?
                    // Je hebt de status EN het user_id nodig
                    ':status' => 'todo',
                    // TODO: Voeg hier de user binding toe
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
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
                // OPDRACHTDEEL 2: Herhaal dezelfde query als hierboven, maar verander 'todo' naar 'in progress'
                // Kopieer de code van hierboven en pas de status aan
                
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'in progress',
                    // TODO: Bind user_id hier ook
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
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
                // OPDRACHTDEEL 3: Doe hetzelfde voor 'review' status
                
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'review',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
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
                // OPDRACHTDEEL 4: Nog een keer voor de 'done' status
                
                $statement = $conn->prepare("SELECT * FROM taken WHERE status = :status AND user = :user ORDER BY deadline ASC");
                $statement->execute([
                    ':status' => 'done',
                    ':user' => $current_user_id
                ]);
                $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tasks as $task) : ?>
                    <div class="task" data-id="<?= $task['id'] ?>" style="position:relative;">
                        <a href="details.php?id=<?= $task['id'] ?>" style="font-weight:bold; color:#0078d4;"><?= $task['titel'] ?></a>
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

<!--
HOE DEZE PAGINA WERKT - Uitleg van de Leraar:
===============================================

1. SESSIE AUTHENTICATIE:
   - Eerst controleren we of de gebruiker ingelogd is met $_SESSION['user_id']
   - Zo niet, sturen we hem/haar naar login.php
   - Dit is VEILIGHEID: alleen ingelogde gebruikers kunnen hun taken zien

2. FILTEREN OP GEBRUIKER:
   - In tegenstelling tot afdeling.php dat filtert op $_GET['afdeling'], 
     filteren we op $_SESSION['user_id']
   - Het user ID komt uit de sessie (ingesteld bij het inloggen)
   - De database heeft een 'user' kolom in de taken tabel die opslaat wie het heeft gemaakt

3. HET QUERY PATROON:
   - We gebruiken dezelfde structuur 4 keer (een keer per kolom/status)
   - Elke query heeft WHERE voorwaarden die BEIDE controleren:
     a) De status (todo, in progress, review, of done)
     b) Het user ID (uit SESSION)
   - We gebruiken placeholders (:status, :user) en binden ze veilig
   - We sorteren op deadline (vroegste eerst)

4. TAKEN WEERGEVEN:
   - Het resultaat wordt doorgelust en weergegeven in kanban-stijl kolommen
   - Elke taak toont: titel, beschrijving, en deadline

JOUW TAKEN:
===========
1. Vervang "TODO_PUT_CONDITIONS_HERE" met de echte WHERE clause
   Hint: Het zou "status = :status AND user = :user" of iets soortgelijks moeten zijn
   
2. In elke execute() oproep, voeg de binding toe voor :user (of hoe je het ook hebt genoemd)
   Hint: ':user' => $current_user_id (of welke variabele naam je hebt gekozen)

Test door:
- Maak een taak aan terwijl je bent ingelogd als user1
- Log uit, log in als user2
- user2 zou de taken van user1 NIET moeten zien op de my.php pagina
- Log weer in als user1 en verifieer dat je je taak ziet
-->
