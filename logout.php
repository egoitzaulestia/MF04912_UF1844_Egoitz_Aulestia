<?php
session_start();
session_destroy();
header("Location: sesion_terminda.php");
exit();
?>