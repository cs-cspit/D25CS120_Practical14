<?php
session_start();
include "db.php";
if(!isset($_SESSION['username']) || $_SESSION['role']!=='admin') die("Access Denied!");
if(!isset($_GET['id'])) die("ID not specified!");
$id=intval($_GET['id']);

$stmt=$conn->prepare("SELECT username FROM users14 WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();
$user=$result->fetch_assoc();
$stmt->close();

if($user['username']=='admin') die("Cannot delete admin!");

$stmt=$conn->prepare("DELETE FROM users14 WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
header("Location: admin_dashboard.php");
exit;
