          <?php if (isset($_GET['error'])): ?>
              <div class="error-message" style="color: red; font-weight: bold; margin-bottom: 20px;">
                  <?= htmlspecialchars($_GET['error']) ?>
              </div>
          <?php endif; ?>
    <?php
    session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }
?>
<!doctype html>
<html lang="nl">

<head>
    <title>TakenLijst</title>
    <?php require_once '../head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
</head>


<body>
    <?php
      $id = $_GET["id"];
      require_once '../backend/conn.php';
        $statement = $conn->prepare("SELECT * FROM taken WHERE id = :id");
         $statement->execute([
            ":id" => $id
         ]);
          $task = $statement->fetch(PDO::FETCH_ASSOC);
      ?>
   
      
      <h1><?php echo $task['titel']; ?></h1>
      <p><?php echo $task['beschrijving']; ?></p>
      <p>Status: <?php echo $task['status']; ?></p>
    <p>Deadline: <?php echo $task['deadline'] !== null ? htmlspecialchars($task['deadline']) : '-'; ?></p>

      <h2>Taak aanpassen</h2>
      <form action="../app/Http/Controllers/tasksController.php" method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= $task['id'] ?>">
          <div class="form-group">
              <label for="titel">Titel:</label>
              <input type="text" name="titel" id="titel" class="form-input" value="<?= htmlspecialchars($task['titel']) ?>" required>
          </div>
          <div class="form-group">
              <label for="beschrijving">Beschrijving:</label>
              <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" required><?= htmlspecialchars($task['beschrijving']) ?></textarea>
          </div>
          <div class="form-group">
              <label for="afdeling">Afdeling:</label>
              <select name="afdeling" id="afdeling" class="form-input" required>
                  <option value="">-- Kies afdeling --</option>
                  <option value="personeel" <?= $task['afdeling'] == 'personeel' ? 'selected' : '' ?>>Personeel</option>
                  <option value="horeca" <?= $task['afdeling'] == 'horeca' ? 'selected' : '' ?>>Horeca</option>
                  <option value="techniek" <?= $task['afdeling'] == 'techniek' ? 'selected' : '' ?>>Techniek</option>
                  <option value="inkoop" <?= $task['afdeling'] == 'inkoop' ? 'selected' : '' ?>>Inkoop</option>
                  <option value="klantenservice" <?= $task['afdeling'] == 'klantenservice' ? 'selected' : '' ?>>Klantenservice</option>
                  <option value="groen" <?= $task['afdeling'] == 'groen' ? 'selected' : '' ?>>Groen</option>
              </select>
          </div>
          <div class="form-group">
              <label for="deadline">Deadline:</label>
              <input type="date" name="deadline" id="deadline" class="form-input" value="<?= htmlspecialchars($task['deadline']) ?>" required>
          </div>
          <button type="submit">Opslaan</button>
      </form>
      
</body>

</html>
