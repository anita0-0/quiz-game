<?php
include "database.php";
session_start();
$_SESSION = [];

session_destroy();

header("Location: categorie.php");