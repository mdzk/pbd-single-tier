<?php
function open_connection()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "20753022_akademik";
    $koneksi = mysqli_connect($hostname, $username, $password, $dbname);
    return $koneksi;
}