<?php
$host = '0.0.0.0';
$port = '6033';
$dbname = 'sql_db';
$user = 'admin';
$pass = '12345';
$db = new PDO("mysql:host=$host; port=$port; dbname=$dbname", $user, $pass);