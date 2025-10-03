<?php
session_start();
include "db.php";
if(!isset($_SESSION['username'])) header("Location: login.php");

$message = "";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $event_date = $_POST['event_date'];

    if(empty($title) || empty($event_date)){
        $message = " Title and Date are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO events14 (title, description, event_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$title,$description,$event_date);
        if($stmt->execute()){
            $message = " Event added successfully!";
        } else {
            $message = " Failed to add event!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
    <style>/* ===== Global Theme Styling ===== */
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

/* ===== Container / Box ===== */
.box, .login-box {
    background: #ffffff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 380px;
    text-align: center;
}

/* ===== Headings ===== */
.box h2, .login-box h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #444;
}

/* ===== Inputs & Textarea ===== */
input, textarea {
    width: 95%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    color: #333;
    background: #f5f4f0; /* light bone */
    outline: none;
}

/* ===== Button ===== */
button {
    width: 100%;
    padding: 12px;
    background: #b08d57; /* golden brown */
    color: #1c1c1c;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    transition: background 0.2s ease-in-out;
}

button:hover {
    background: #9d7a4d; /* darker golden brown */
}

/* ===== Message Box ===== */
.msg {
    margin-top: 12px;
    background: #333;
    color: #b08d57;
    padding: 8px;
    border-radius: 6px;
    font-weight: bold;
}

/* ===== Links ===== */
a {
    display: block;
    margin-top: 14px;
    color: #b08d57;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s ease-in-out;
}

a:hover {
    color: #c19774;
}

    </style>
</head>
<body>
    <div class="box">
        <h2>Add Event</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Event Title" required><br>
            <textarea name="description" placeholder="Event Description"></textarea><br>
            <input type="date" name="event_date" required><br>
            <button type="submit">Add Event</button>
        </form>
        <?php if(!empty($message)) echo "<p class='msg'>$message</p>"; ?>
        <a href="read_events.php">View All Events</a>
    </div>
</body>
</html>
