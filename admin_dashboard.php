<?php
session_start();
include "db.php";
/*if(!isset($_SESSION['username']) || $_SESSION['role']!=='admin') die("Access Denied!");
*/
$result = $conn->query("SELECT id,username,role,created_at FROM users14 ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            background: #121212;
            font-family: "Roboto", sans-serif;
            padding: 20px;
            color: #eee;
        }

        h2 {
            text-align: center;
            color: #ffcc00;
            font-size: 28px;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .card {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 12px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 6px 15px rgba(0,0,0,0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background: #2a2a2a;
            color: #ffcc00;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background: #2a2a2a;
        }

        tr:hover {
            background: #333;
        }

        a {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .delete {
            background: #e53935;
            color: white;
        }

        .delete:hover {
            background: #b71c1c;
        }

        a.back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #3949ab;
            color: white;
            border-radius: 8px;
            font-weight: bold;
        }

        a.back:hover {
            background: #1a237e;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h2>Admin Dashboard — Users</h2>
    <div class="card">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php while($row=$result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo htmlspecialchars($row['username']);?></td>
                <td><?php echo $row['role'];?></td>
                <td><?php echo $row['created_at'];?></td>
                <td>
                    <?php if($row['username']!=='admin'): ?>
                        <a href="delete_user.php?id=<?php echo $row['id'];?>" class="delete" onclick="return confirm('Delete this user?')">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php" class="back">Back to Dashboard</a>
    </div>
</body>
</html>
