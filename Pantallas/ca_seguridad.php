<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../Pantallas/index.php");
    exit;
}
