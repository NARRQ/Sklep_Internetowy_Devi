<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php?info=logged_out');
exit();
?>