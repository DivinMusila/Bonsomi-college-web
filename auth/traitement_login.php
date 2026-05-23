<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

$email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($email) || empty($password)) {
    header('Location: login.php?erreur=1');
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, nom, prenom, email, mot_de_passe, role FROM utilisateurs WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            switch ($user['role']) {
                case 'admin':
                    header('Location: ../dashboard/admin/index.php');
                    break;
                case 'prof':
                    header('Location: ../dashboard/prof/index.php');
                    break;
                case 'eleve':
                    header('Location: ../dashboard/eleve/index.php');
                    break;
                default:
                    header('Location: ../index.php');
            }
            exit();
        }
    }
    
    header('Location: login.php?erreur=1');
    exit();
} catch (PDOException $e) {
    header('Location: login.php?erreur=1');
    exit();
}