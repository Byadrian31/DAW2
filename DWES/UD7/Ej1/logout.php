<?php
/**
 * @author Adrián López Pascual
 */
session_start();
session_destroy();
header("Location: ./1.php");
exit();
?>
