<?php 
require("../sistem/koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_POST["id"];
$sql = @$_POST["sql"];
switch ($sql) {
    case "create":
        create_prodi();
        break;
    case "update":
        update_prodi();
        break;
    case "delete":
        delete_prodi();
        break;
}
switch ($a) {
    case "list":
        read_data();
        break;
    case "input"
        input_data();
    break;
        case "edit"
        input_data();
    break;
        case "hapus"
        input_data();
    break;
    default:
        read_data();
        break;
}
mysqli_close($hub);
?>