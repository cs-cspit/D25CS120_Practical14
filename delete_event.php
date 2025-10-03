<?php
session_start();
include "db.php";
if(!isset($_SESSION['username'])) header("Location: login.php");

if(!isset($_GET['id'])) die("ID not specified!");
$id=intval($_GET['id']);

$stmt=$conn->prepare("DELETE FROM events14 WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
header("Location: read_events14.php");
exit;
?>