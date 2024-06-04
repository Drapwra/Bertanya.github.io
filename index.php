<?php

session_start();
if (!isset($_SESSION['start'])) {
  header("Location:login.php");
} else {
  header("Location:guru");
}