<?php session_start(); if(!isset($_SESSION['codUSUARIO'])) { ?><script language="javascript1.2">window.location.href='login.php';</script><?php } $codUSUARIO = $_SESSION['codUSUARIO']; ?>