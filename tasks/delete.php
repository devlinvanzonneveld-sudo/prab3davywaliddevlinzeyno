<?php
session_start();
    if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen!";
        header("Location: ../login.php?msg=$msg");
        exit;
    }
require_once '../backend/conn.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];
$statement = $conn->prepare("DELETE FROM taken WHERE id = :id");
$statement->execute([':id' => $id]);
header('Location: index.php?delete_success=1');
exit;