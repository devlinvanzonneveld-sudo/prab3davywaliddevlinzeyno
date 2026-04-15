<?php

$action = isset($_POST["action"]) ? $_POST["action"] : '';
if ($action == "update") {
    session_start();
    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $titel = isset($_POST["titel"]) ? $_POST["titel"] : '';
    $beschrijving = isset($_POST["beschrijving"]) ? $_POST["beschrijving"] : '';
    $afdeling = isset($_POST["afdeling"]) ? $_POST["afdeling"] : '';
    $deadline = isset($_POST["deadline"]) ? $_POST["deadline"] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($id === '' || $titel === '' || $beschrijving === '' || $afdeling === '' || $deadline === '' || !$user_id) {
        header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/details.php?id=' . urlencode($id) . '&error=Vul alle velden in aub.');
        exit;
    }

    require_once '../../../backend/conn.php';
    $sql = "UPDATE taken SET titel = ?, beschrijving = ?, afdeling = ?, deadline = ? WHERE id = ? AND user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $afdeling, $deadline, $id, $user_id]);

    header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/index.php?edit_success=1');
    exit;
}


$action = isset($_POST["action"]) ? $_POST["action"] : '';
if ($action == "create") 
{
    session_start();
    $titel = isset($_POST["titel"]) ? $_POST["titel"] : '';
    $beschrijving = isset($_POST["beschrijving"]) ? $_POST["beschrijving"] : '';
    $afdeling = isset($_POST["afdeling"]) ? $_POST["afdeling"] : '';
    $deadline = isset($_POST["deadline"]) ? $_POST["deadline"] : '';
    $status = 'todo';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($titel === '' || $beschrijving === '' || $afdeling === '' || $deadline === '' || !$user_id) {
        header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/create.php?error=Vul alle velden in aub.');
        exit;
    }

    require_once '../../../backend/conn.php';
    $sql = "INSERT INTO taken (titel, beschrijving, afdeling, deadline, status, user) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $afdeling, $deadline, $status, $user_id]);

    header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/create.php?success=1');
    exit;
}
