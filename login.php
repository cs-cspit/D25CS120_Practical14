<?php
session_start();
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $message = " All fields are required!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users14 WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows===1){
            $row = $result->fetch_assoc();
            if(password_verify($password,$row['password'])){
                $_SESSION['username']=$username;
                $_SESSION['role']=$row['role'];
                header("Location: dashboard.php");
                exit;
            } else $message=" Incorrect password!";
        } else $message=" Username not found!";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            width: 360px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 15px;
            color: #444;
        }

        input {
            width: 92%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 95%;
            padding: 12px;
            background: #b08d57; /* golden brown */
            border: none;
            color: #1c1c1c;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s ease-in-out;
        }
        button:hover {
            background: #9d7a4d;
        }

        .msg {
            margin-top: 12px;
            background: #fff4e6;
            color: #8e5a2d;
            padding: 8px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
        }

        p {
            margin-top: 14px;
            font-size: 14px;
        }

        a {
            color: #b08d57;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="box">
    <h2> Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if(!empty($message)) echo "<p class='msg'>$message</p>"; ?>
    <p>New user? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
