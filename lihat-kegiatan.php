<?php
include 'db.php';

$query_kegiatan = mysqli_query($conn, "SELECT * FROM informasikegiatan ORDER BY tanggal");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Masjid Ar-Rahmah</title>
    <!--------------------Font Inter-------------------------------------------->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!--------------------Flowbite-------------------------------------------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
    <!--------------------CSS-------------------------------------------->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .back-btn {
            width: 91%;
            margin: 0 auto;
        }

        .back-btn a {
            display: inline-flex;
            align-items: center;
            gap: 27px;
        }
    </style>
</head>

<body>
    <div id="navbar">
        <div class="logo">
            <a href="index.php"><img src="img/logo.jpg" alt=""></a>
        </div>
        <div class="button">
            <a href="login.php"><button id="login-btn">Login</button></a>
        </div>
    </div>
    <hr>
    <div id="more-info">
        <div class="back-btn">
            <a href="index.php">
                <img src="img/panahkiri.svg" alt="">
                <p>Kembali</p>
            </a>
        </div>
        <center>
            <div class="head-info">
                <h1>Informasi Kegiatan</h1>
                <br>
                <h4>Kegiatan - kegiatan yang akan dan telah dilaksanakan pada Masjid Ar - Rahmah </h4>
            </div>
        </center>

        <div class="card-section">
            <?php
            if (mysqli_num_rows($query_kegiatan) > 0) {
                while ($fetch_data = mysqli_fetch_array($query_kegiatan)) {
            ?>
                    <div class="card">
                        <div class="image-card">
                            <img src="kegiatan/<?php echo $fetch_data['gambar'] ?>" alt="">
                        </div>
                        <div class="title-card">
                            <h2><?php echo $fetch_data['namakegiatan'] ?></h2>
                        </div>
                        <div class="text-card">
                            <p><?php echo substr($fetch_data['deskripsi'], 0, 100)  ?></p>
                        </div>
                        <div class="button-card">
                            <a href="detail-kegiatan.php?id=<?php echo $fetch_data['id'] ?>"><button id="read-more-btn">Read More</button></a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <div id="footer">
        <div class="title">
            <h1>CONTACT</h1>
        </div>
        <div class="content">
            <div class="text-content">
                <p>Perumnas BCK Blok D RT 05/RW 10</p>
            </div>
            <div class="text-content">
                <p>Cilegon, Banten</p>
            </div>
            <div class="text-content">
                <p>Telp (021) 123456</p>
            </div>
            <div class="text-content">
                <p>Email : masjidar-rahmah@gmail.com</p>
            </div>
        </div>
        <div class="break-line">
            <hr>
        </div>
        <div class="additional-info">
            <p>Design with love by Masjid Ar Rahmah. All Rights reserved</p>
        </div>
    </div>
</body>

</html>