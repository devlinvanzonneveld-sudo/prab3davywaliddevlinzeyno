<?php


$action = isset($_POST["action"]) ? $_POST["action"] : '';
if ($action == "create") 
{
    $titel = isset($_POST["titel"]) ? $_POST["titel"] : '';
    $beschrijving = isset($_POST["beschrijving"]) ? $_POST["beschrijving"] : '';
    $afdeling = isset($_POST["afdeling"]) ? $_POST["afdeling"] : '';
    $status = 'todo';

 
    if ($titel === '' || $beschrijving === '' || $afdeling === '') {
        echo "Vul alle velden in aub.";
        exit;
    }

    require_once '../../../backend/conn.php';
    $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $afdeling, $status]);

    header('Location: /pra-b3-2026-feb-walid-davy-zeyno-devlin/tasks/create.php?success=1');
    exit;




} 
