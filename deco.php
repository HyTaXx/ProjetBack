<?php


require_once 'classes/connection.php';

session_start();

session_destroy();

header('Location: index.php');

die();
