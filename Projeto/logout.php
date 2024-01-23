<?php
include("Models/config.php");

session_destroy();
header("Location: index.php");
die();