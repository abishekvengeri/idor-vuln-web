<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$db = new SQLite3('users.db');
// IDOR Vulnerability: No authorization check!
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(':id', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

if (!$user) {
    $error = "User not found!";
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Cyber Grid</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #047857);
            overflow: hidden;
        }
        .profile-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 500px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        h1 {
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 48px;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }
        .profile-info {
            color: #fff;
            font-size: 20px;
            text-align: center;
        }
        .profile-info span {
            color: #34d399;
            font-weight: bold;
        }
        .hint {
            color: #a1a1aa;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
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
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #34d399;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        a:hover {
            color: #6ee7b7;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } else { ?>
            <div class="profile-info">
                <p><span>Username:</span> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><span>Bio:</span> <?php echo htmlspecialchars($user['bio']); ?></p>
                <p><span>ID:</span> <?php echo $user['id']; ?></p>
            </div>
        <?php } ?>
        <p class="hint">Exploit the grid: Try <code>?id=</code> in the URL!</p>
        <a href="logout.php">Disconnect</a>
    </div>
</body>
</html>
