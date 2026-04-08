<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: login.php?msg=$msg");
        exit;
    }



require_once 'backend/conn.php';

// Controleer of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $title = htmlspecialchars($_POST["title"]);
    $beschrijving = htmlspecialchars($_POST["beschrijving"]);
    $afdeling = htmlspecialchars($_POST["afdeling"]);
    $status = htmlspecialchars($_POST["status"]);

    // UPDATE query uitvoeren
    $statement = $conn->prepare("UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status WHERE id = :id");
    $statement->execute([
        ":titel" => $title,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
        ":status" => $status,
        ":id" => $id
    ]);

    header('Location: tasks/index.php?edit_success=1');
    exit;
}

$id = $_GET["id"];
$statement = $conn->prepare("SELECT * FROM taken WHERE id = :id");
$statement->execute([
    ":id" => $id
]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP Formulier</title>
</head>
<body>

<h1>editformulier</h1>

<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    
    <label>title:</label><br>
    <input type="text" name="title" value="<?php echo $task['titel']; ?>"><br><br>
    
    <label>beschrijving:</label><br>
    <textarea name="beschrijving"><?php echo $task['beschrijving']; ?></textarea><br><br>
    
    <label>afdeling:</label><br>
    <input type="text" name="afdeling" value="<?php echo $task['afdeling']; ?>"><br><br>
    
    <label>status:</label><br>
    <select name="status">
        <option value="open" <?php if($task['status'] == 'open') echo 'selected'; ?>>open</option>
        <option value="in progress" <?php if($task['status'] == 'in progress') echo 'selected'; ?>>in progress</option>
        <option value="review" <?php if($task['status'] == 'review') echo 'selected'; ?>>review</option>
        <option value="done" <?php if($task['status'] == 'done') echo 'selected'; ?>>done</option>
    </select><br><br>
    
    <button type="submit">opslaan</button>
</form>

</body>
</html>