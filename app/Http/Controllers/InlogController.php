<?php
require_once '../../../backend/conn.php';

$username = isset($_POST["username"]) ? $_POST["username"] : '';
$password = isset($_POST["password"]) ? $_POST["password"] : '';

$query = "SELECT id, username, password FROM users WHERE username = :username ";
$statement = $conn->prepare($query);
$statement->execute([
    "username" => $username
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
session_start();
if($statement->rowCount() < 1){
    die("Error: account bestaat niet");
}

if(!password_verify($password, $user['password']))
    {
        die("Error: wachtwoord is niet juist!");
    }
$_SESSION['user_id'] = $user['id'];
header("Location: ../../../../index.php?msg=logged in was succesfully");

?>