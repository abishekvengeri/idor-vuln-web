<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new SQLite3('users.db');
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: profile.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cyber Grid</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e1e2f, #3b1b5e, #2a4066);
            overflow: hidden;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 400px;
            animation: glow 2s infinite alternate;
        }
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(255, 255, 255, 0.2); }
            to { box-shadow: 0 0 40px rgba(255, 255, 255, 0.4); }
        }
        h1 {
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            background: #2a2a3d;
            border: 1px solid #444;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: border 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border: 1px solid #8a4af3;
            box-shadow: 0 0 10px #8a4af3;
        }
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #8a4af3, #3b82f6);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(138, 74, 243, 0.7);
        }
        .error {
            color: #ff4d4d;
            text-align: center;
            margin-bottom: 20px;
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Cyber Grid</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Access Grid</button>
        </form>
    </div>
</body>
</html>
