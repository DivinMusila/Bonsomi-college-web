<?php
session_start();
require_once '../config.php';

if (isset($_SESSION['id'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: ../dashboard/admin/index.php');
            break;
        case 'prof':
            header('Location: ../dashboard/prof/index.php');
            break;
        case 'eleve':
            header('Location: ../dashboard/eleve/index.php');
            break;
    }
    exit();
}

$message = '';
if (isset($_GET['erreur']) && $_GET['erreur'] === '1') {
    $message = 'Email ou mot de passe incorrect';
}
if (isset($_GET['success']) && $_GET['success'] === '1') {
    $message = 'Compte créé. Veuillez vous connecter.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - Bonsomi College</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo {
            font-size: 40px;
            margin-bottom: 15px;
        }
        .login-header h1 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .form-label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .alert-error {
            color: #d32f2f;
            background-color: #ffebee;
            border: 1px solid #ef5350;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .alert-success {
            color: #388e3c;
            background-color: #e8f5e9;
            border: 1px solid #4caf50;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">🎓</div>
            <h1>Se connecter</h1>
            <p>Bonsomi College</p>
        </div>

        <?php if (!empty($message)): ?>
            <?php if (strpos($message, 'incorrect') !== false): ?>
                <div class="alert-error"><?php echo htmlspecialchars($message); ?></div>
            <?php else: ?>
                <div class="alert-success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="traitement_login.php">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="register-link">
            Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a>
        </div>
    </div>
</body>
</html>