<?php
session_start();
if(!isset($_SESSION['username'])) header("Location: login14.php?msg=Please login!");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard 14</title>
<style>
    body {
        margin: 0;
        background: #f8f7f4; /* bone white */
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    .box {
        background: #ffffff;
        padding: 30px 25px;
        border-radius: 12px;
        width: 380px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
        margin-bottom: 20px;
        color: #444;
    }

    a {
        display: block;
        margin: 10px auto;
        padding: 12px;
        background: #b08d57; /* golden brown */
        border-radius: 6px;
        color: #1c1c1c;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.2s ease-in-out;
        width: 80%;
    }
    a:hover {
        background: #9d7a4d;
    }

    .admin-link {
        background: #d4a373; /* slightly different brown for admin */
    }
    .admin-link:hover {
        background: #c19774;
    }
</style>
</head>
<body>
<div class="box">
    <h2>👤 Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="create_event14.php">➕ Add Event</a>
    <a href="read_events14.php">📋 View Events</a>
    <?php if(isset($_SESSION['role']) && $_SESSION['role']=='admin'): ?>
        <a href="admin_dashboard14.php" class="admin-link">🛠 Admin Dashboard</a>
    <?php endif; ?>
    <a href="logout14.php">🚪 Logout</a>
</div>
</body>
</html>
