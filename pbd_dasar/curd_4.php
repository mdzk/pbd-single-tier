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

<!-- Baris terakhir 162 -->
<?php
function create_prodi() {
    global $hub;
    global $_POST;
    $query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) VALUES";
    $query .= " ('" .$_POST["kdprodi"]."', '" .$_POST["nmprodi"]."',
    '".$_POST["akreditasi"]."')";
    mysqli_query($hub, $query) or die(mysql_error());
}

function update_prodi(){
    global $hub;
    global $_POST;
    $query = "UPDATE dt_prodi";
    $query = " SET kdprodi='" .$_POST["kdprodi"]."', nmprodi= '".
    $_POST ["nmprodi"]."', akreditasi='".$_POST["akreditasi"]."'";
    $query .= " WHERE idprodi = ".$_POST["idprodi"];
    mysqli_query($hub, $query) or die (mysql_error());
}

function delete_prodi() {
    global $hub;
    global $_POST;
    $query .= " WHERE idprodi = ".$_POST["idprodi"];
    mysqli_query($hub, $query) or die (mysql_error());
}
?>