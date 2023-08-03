<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'database_masjid';

$conn = mysqli_connect($hostname, $username, $password, $dbname) or die('Gagal terhubung dengan database');
