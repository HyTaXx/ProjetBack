<?php

session_start();
require_once 'classes/connection.php';
require_once 'classes/user.php';
require_once 'classes/album.php';

$connection = new Connection();

$sender_id = $_SESSION['id'];
$recipient_id = $_POST['recipient_id'];
$album_id = $_POST['album_id'];
$status = "envoyee";

$connection->sendInvite($sender_id, $recipient_id, $album_id, $status);
