<?php
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $message = " All fields are required!";
    } elseif(strlen($username)<3){
        $message = " Username must be at least 3 characters!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users14 (username,password) VALUES (?,?)");
        $stmt->bind_param("ss",$username,$hashed);

        if($stmt->execute()){
            $message = " Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $message = " Username already exists!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: #f8f7f4; /* bone white */
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            background: #b08d57; /* golden brown */
            padding: 25px;
            border-radius: 12px;
            width: 360px;
            color: #1c1c1c;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        h2 {
            margin-bottom: 15px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        button {
            width: 95%;
            padding: 10px;
            background: #7b5e28; /* darker brown */
            border: none;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
            transition: background 0.2s;
        }
        button:hover {
            background: #60481f;
        }
        .msg {
            margin-top: 12px;
            background: #fff;
            color: #7b5e28;
            padding: 8px;
            border-radius: 6px;
            font-weight: bold;
        }
        a {
            color: #1c1c1c;
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
    <h2> Register</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Choose Username" required><br>
        <input type="password" name="password" placeholder="Create Password" required><br>
        <button type="submit">Register</button>
    </form>
    <?php if(!empty($message)) echo "<p class='msg'>$message</p>"; ?>
    <p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>
