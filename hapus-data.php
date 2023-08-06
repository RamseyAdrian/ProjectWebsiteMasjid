<?php 
include 'db.php';

if (isset($_GET['idpem'])) {
    $hapus_pemasukkan = mysqli_query($conn, "DELETE FROM pemasukkan WHERE id = '".$_GET['idpem']."' ");
    echo '<script>window.location="pemasukkan.php"</script>';
}
