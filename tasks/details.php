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

      <button>
             <a href = "../edit.php?id=<?= $task['id'] ?>">aanpassen</a>
      </button>
      
</body>

</html>
