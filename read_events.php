<?php
session_start();
include "db.php";
if(!isset($_SESSION['username'])) header("Location: login.php");

$result = $conn->query("SELECT * FROM events14 ORDER BY event_date ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Events</title>
    <style>
        body {
            background: #f8f7f4; /* bone white */
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            color: #333;
        }

        h2 {
            margin-bottom: 15px;
            color: #444;
        }

        .create {
            background: #b08d57; /* golden brown */
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 14px;
            border-radius: 6px;
            color: #1c1c1c;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .create:hover {
            background: #9d7a4d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #b08d57;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background: #f9f5ee;
        }

        a.action {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            margin-right: 5px;
            display: inline-block;
        }

        .edit {
            background: #ffb74d; /* warm orange */
            color: #1c1c1c;
        }
        .edit:hover {
            background: #ffa726;
        }

        .delete {
            background: #e57373; /* warm red */
            color: #fff;
        }
        .delete:hover {
            background: #d32f2f;
        }
    </style>
</head>
<body>
    <h2> All Events</h2>
    <a href="create_event.php" class="create"> Add New Event</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Event Date</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td>
                <a href="update_event.php?id=<?php echo $row['id']; ?>" class="action edit">✏ Edit</a>
                <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="action delete" onclick="return confirm('Are you sure?')">🗑 Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
