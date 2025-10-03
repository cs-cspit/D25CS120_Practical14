<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php?msg=You have logged out successfully.");
exit;
?>