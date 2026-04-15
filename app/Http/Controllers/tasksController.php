<?php


$action = isset($_POST["action"]) ? $_POST["action"] : '';
if ($action == "create") 
{
    session_start();
    $titel = isset($_POST["titel"]) ? $_POST["titel"] : '';
    $beschrijving = isset($_POST["beschrijving"]) ? $_POST["beschrijving"] : '';
    $afdeling = isset($_POST["afdeling"]) ? $_POST["afdeling"] : '';
    $status = 'todo';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($titel === '' || $beschrijving === '' || $afdeling === '' || !$user_id) {
        echo "Vul alle velden in aub.";
        exit;
    }

    require_once '../../../backend/conn.php';
    $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status, user) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $afdeling, $status, $user_id]);

    header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/create.php?success=1');
    exit;
}
