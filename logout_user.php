<?php
session_start();
unset($_SESSION['user_logged_in']);
unset($_SESSION['id_user']);
unset($_SESSION['nama_user']);

header("Location: index.php");
exit();
?>