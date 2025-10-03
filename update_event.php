<?php
session_start();
include "db.php";
if(!isset($_SESSION['username'])) header("Location: login.php");

if(!isset($_GET['id'])) die("ID not specified!");
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM events14 WHERE id=$id");
if($result->num_rows!==1) die("Event not found!");
$event = $result->fetch_assoc();

$message="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $event_date = $_POST['event_date'];

    if(empty($title) || empty($event_date)){
        $message = " Title and Date are required!";
    } else {
        $stmt = $conn->prepare("UPDATE events14 SET title=?, description=?, event_date=? WHERE id=?");
        $stmt->bind_param("sssi",$title,$description,$event_date,$id);
        if($stmt->execute()){
            $message = " Event updated successfully!";
            $event['title']=$title;
            $event['description']=$description;
            $event['event_date']=$event_date;
        } else {
            $message = " Failed to update event!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Event</title>
    <style>
        body {
            background:#f8f7f4; /* bone white */
            font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }
        .box {
            background:#b08d57; /* golden brown */
            padding:25px;
            border-radius:12px;
            width:400px;
            color:#1c1c1c;
            text-align:center;
            box-shadow:0 6px 15px rgba(0,0,0,0.15);
        }
        h2 {
            margin-bottom:15px;
            color:#1c1c1c;
        }
        input, textarea {
            width:90%;
            padding:10px;
            margin:8px 0;
            border-radius:6px;
            border:1px solid #ccc;
            font-size:15px;
        }
        button {
            width:95%;
            padding:10px;
            background:#7b5e28; /* darker brown */
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;
            font-size:15px;
            transition:background 0.2s;
        }
        button:hover {
            background:#60481f;
        }
        .msg {
            margin-top:12px;
            background:#fff;
            color:#7b5e28;
            padding:8px;
            border-radius:6px;
            font-weight:bold;
        }
        a {
            display:block;
            margin-top:12px;
            color:#1c1c1c;
            font-weight:bold;
            text-decoration:none;
        }
        a:hover {
            text-decoration:underline;
        }
    </style>
</head>
<body>
<div class="box">
    <h2> Update Event</h2>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required><br>
        <textarea name="description"><?php echo htmlspecialchars($event['description']); ?></textarea><br>
        <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required><br>
        <button type="submit">Update Event</button>
    </form>
    <?php if(!empty($message)) echo "<p class='msg'>$message</p>"; ?>
    <a href="read_events.php">⬅ Back to Events</a>
</div>
</body>
</html>
