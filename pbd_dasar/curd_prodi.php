<?php
require("../sistem/koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
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
    case "input":
        input_data();
        break;
    case "edit":
        edit_data($id);
        break;
    case "hapus":
        hapus_data($id);
        break;
    default:
        read_data();
        break;
}
mysqli_close($hub);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        
    </style>
</head>
<body>
    
    <?php
    function read_data() {
        global $hub;
        $query = "select * from dt_prodi";
        $result = mysqli_query($hub, $query); ?>
        
        <h2>Read Data Program Studi</h2>
        <table border=1 cellpadding=2>
            <tr>
                <td colspan="5"><a href="curd_prodi.php?a=input">INPUT</a></td>
            </tr>
            <tr>
                <td>ID</td>
                <td>KODE</td>
                <td>NAMA PRODI</td>
                <td>AKREDITASI</td>
                <td>AKSI</td>
            </tr>
            <?php while($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['idprodi']; ?></td>
                <td><?php echo $row['kdprodi']; ?></td>
                <td><?php echo $row['nmprodi']; ?></td>
                <td><?php echo $row['akreditasi']; ?></td>
                <td>
                    <a href="curd_prodi.php?a=edit&id=<?php echo $row['idprodi']; ?>">EDIT</a>
                    <a href="curd_prodi.php?a=hapus&id=<?php echo $row['idprodi']; ?>">HAPUS</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    <?php } ?>

    <?php
    function input_data() {
        $row = array(
            "kdprodi" => "",
            "nmprodi" => "",
            "akreditasi" => "-"
        ); ?>

        <h2>Input Data Program Studi</h2>
        <form name="latihan" action="curd_prodi.php?a=list" method="post" onsubmit="return validate()">
            <input type="hidden" name="sql" value="create">
            Kode Prodi
            <input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
            <br>
            Nama Prodi
            <input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
            <br>
            Akreditasi Prodi
            <input type="radio" name="akreditasi" value="-" <?php if($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
            <input type="radio" name="akreditasi" value="A" <?php if($row["akreditasi"]=='A') { echo "checked=\"checked\""; } else {echo ""; } ?>> A
            <input type="radio" name="akreditasi" value="B" <?php if($row["akreditasi"]=='B') { echo "checked=\"checked\""; } else {echo ""; } ?>> B
            <input type="radio" name="akreditasi" value="C" <?php if($row["akreditasi"]=='C') { echo "checked=\"checked\""; } else {echo ""; } ?>> C
            <br>
            <input type="submit" name="action" value="Simpan">
            <br>
            <a href="curd_prodi.php?a=list">Batal</a>
        </form>
    <?php } ?>

    <?php 
    function edit_data($id) {
        global $hub;
        $query  = "select * from dt_prodi where idprodi = $id";
        $result = mysqli_query($hub, $query);
        $row    = mysqli_fetch_array($result); ?>

        <h2>Edit Data Program Studi</h2>
        <form action="curd_prodi.php?a=list" method="post">
            <input type="hidden" name="sql" value="update">
            <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
            Kode Prodi
            <input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
            <br>
            Nama Prodi
            <input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
            <br>
            Akreditasi Prodi
            <input type="radio" name="akreditasi" value="-" <?php if($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
            <input type="radio" name="akreditasi" value="A" <?php if($row["akreditasi"]=='A' ) { echo "checked=\"checked\""; } else {echo "";} ?> > A
            <input type="radio" name="akreditasi" value="B" <?php if($row["akreditasi"]=='B' ) { echo "checked=\"checked\""; } else {echo "";} ?> > B
            <input type="radio" name="akreditasi" value="C" <?php if($row["akreditasi"]=='C' ) { echo "checked=\"checked\""; } else {echo "";} ?> > C
            <br>
            <input type="submit" name="action" value="Simpan">
            <br>
            <a href="curd_prodi.php?a=list">Batal</a>
        </form>
    <?php } ?>

    <?php
    function hapus_data($id) {
        global $hub;
        $query  = "select * from dt_prodi where idprodi = $id";
        $result = mysqli_query($hub, $query);
        $row    = mysqli_fetch_array($result); ?>

        <h2>Hapus Data Program Studi</h2>
        <form action="curd_prodi.php?a=list" method="post">
            <input type="hidden" name="sql" value="delete">
            <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
            <table>
                <tr>
                    <td width=100>kode</td>
                    <td><?php echo trim($row["kdprodi"]) ?></td>
                </tr>
                <tr>
                    <td>Nama Prodi</td>
                    <td><?php echo trim($row["nmprodi"]) ?></td>
                </tr> 
                <tr>
                    <td>Akreditasi</td>
                    <td><?php echo trim($row["akreditasi"]) ?></td>
                </tr>
            </table>
            <br>
            <input type="submit" name="action" value="Hapus">
            <br>
            <a href="curd_prodi.php?a=list">Batal</a>
        </form>
    <?php } ?>

    <?php
    function create_prodi() {
        global $hub;
        global $_POST;
        $kdprodi = $_POST['kdprodi'];
        $nmprodi = $_POST['nmprodi'];

        $query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) VALUES ";
        $query .= " ('". $_POST["kdprodi"]."', '".$_POST["nmprodi"]."', '".$_POST["akreditasi"]."')";
        $row = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi' OR kdprodi = '$kdprodi'");
        if (mysqli_num_rows($row) > 0) {
            echo "<script>alert('kode prodi atau nama prodi sudah ada di database');</script>";
        } else {
            mysqli_query($hub, $query) or die(mysqli_error($hub));
        }
    }

    function update_prodi() {
        global $hub;
        global $_POST;

        $query = "UPDATE dt_prodi";
        $query .= " SET kdprodi='" . $_POST["kdprodi"]."', nmprodi= '". $_POST["nmprodi"]."', akreditasi='". $_POST["akreditasi"]."'";
        $query .= " WHERE idprodi = ".$_POST["idprodi"];

        $kdprodi = $_POST['kdprodi'];
        $nmprodi = $_POST['nmprodi'];
        $akreditasi = $_POST['akreditasi'];
        $id = $_POST['idprodi'];

        $cekNamaProdi = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi' AND idprodi = '$id'");
        $cekNamaProdiLain = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi'");
        $cekKodeProdi = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE kdprodi = '$kdprodi' AND idprodi = '$id'");
        $cekKodeProdiLain = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE kdprodi = '$kdprodi'");

        if (mysqli_num_rows($cekNamaProdi) == 1 && mysqli_num_rows($cekKodeProdi) == 1) {
            header('Location: curd_prodi.php');
        } else if (mysqli_num_rows($cekKodeProdi) == 1 && mysqli_num_rows($cekNamaProdiLain) == 0) {
            echo "<script>alert('nama prodi diperbarui');</script>";
            mysqli_query($hub, "UPDATE dt_prodi SET nmprodi='$nmprodi', akreditasi='$akreditasi' WHERE idprodi='$id'");
        } else if (mysqli_num_rows($cekNamaProdi) == 1 && mysqli_num_rows($cekKodeProdiLain) == 0) {
            echo "<script>alert('kode prodi diperbarui');</script>";
            mysqli_query($hub, "UPDATE dt_prodi SET kdprodi='$kdprodi', akreditasi='$akreditasi' WHERE idprodi='$id'");
        } else if (mysqli_num_rows($cekKodeProdiLain) > 0 && mysqli_num_rows($cekNamaProdi) == 1) {
            echo "<script>alert('kode prodi already exist');</script>";
        } else if (mysqli_num_rows($cekNamaProdiLain) > 0 && mysqli_num_rows($cekKodeProdi) == 1) {
            echo "<script>alert('nama prodi already exist');</script>";
        } else {
            echo "<script>alert('semua data berhasil diperbarui');</script>";
            mysqli_query($hub, $query) or die (mysqli_error($hub));
        }
    }

    function delete_prodi() {
        global $hub;
        global $_POST;
        $query  = "DELETE FROM dt_prodi";
        $query .= " WHERE idprodi = ".$_POST["idprodi"];
        mysqli_query($hub, $query) or die (mysqli_error($hub));
    }
    ?>

    <script type="text/javascript">
        function validate() {
            if (document.forms["latihan"]["kdprodi"].value == "") {
                alert("Nama Tidak Boleh Kosong");
                document.forms["latihan"]["kdprodi"].focus();
                return false;
            }
            if (document.forms["latihan"]["nmprodi"].value == "") {
                alert("Nmprodi Tidak Boleh Kosong");
                document.forms["latihan"]["nmprodi"].focus();
                return false;
            }
            if (document.forms["latihan"]["akreditasi"].selectedIndex < 1) {
                alert("Pilih Jurusan.");
                document.forms["latihan"]["akreditasi"].focus();
                return false;
            }
        }
    </script>

</body>
</html>