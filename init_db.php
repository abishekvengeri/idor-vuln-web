<?php
$db = new SQLite3('users.db');
$db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT, bio TEXT)");
$db->exec("INSERT OR IGNORE INTO users (id, username, password, bio) VALUES (1, 'alice', 'pass123', 'I love coding!')");
$db->exec("INSERT OR IGNORE INTO users (id, username, password, bio) VALUES (2, 'bob', 'pass456', 'Gamer and foodie.')");
$db->exec("INSERT OR IGNORE INTO users (id, username, password, bio) VALUES (3, 'charlie', 'secret789', 'Coffee enthusiast.')");
$db->exec("INSERT OR IGNORE INTO users (id, username, password, bio) VALUES (4, 'diana', 'diana2023', 'Nature lover and hiker.')");
$db->exec("INSERT OR IGNORE INTO users (id, username, password, bio) VALUES (5, 'eve', 'eve999', 'Aspiring artist.')");

echo "Database initialized with additional users!";
$db->close();
?>
