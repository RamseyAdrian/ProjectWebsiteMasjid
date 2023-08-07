<?php
include 'db.php';

$query_kegiatan = mysqli_query($conn, "SELECT * FROM informasikegiatan ORDER BY tanggal LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Masjid Ar-Rahmah</title>
    <!--------------------Flowbite-------------------------------------------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
    <!--------------------CSS-------------------------------------------->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="navbar">
        <div class="logo">
            <img src="img/logo.jpg" alt="">
        </div>
        <div class="button">
            <a href="login.php"><button id="login-btn">Login</button></a>
        </div>
    </div>
    <hr>

    <div id="hero">
        <div class="hero-box">
            <div class="text-section">
                <div class="upper-text">
                    <h4>Assalamualaikum,<br>
                        Selamat datang website di DKM Masjid Ar Rohmah<br> Perumas BCK Blok D, Cilegon.</h4>
                </div>
                <div class="lower-text">
                    <h4>Website ini merupakan media informasi Pengurus DKM <br> dan Jamaah Masjid Ar-Rohmah, Blok D Perumnas Bumi Cibeber <br> Kencana,Cilegon, Banten.</h4>
                </div>
            </div>
        </div>
    </div>
    <div id="praying-info">
        <div class="text-section">
            <h3>Praying Time</h3>
            <br>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br> sed do eiusmod tempor incididunt ut labore
                et
                dolore magna aliqua.<br>

                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br>
                consequat.</h4>
        </div>
        <div class="table-praying">
            <img src="img/Table.png" alt="">
        </div>
    </div>
    <div id="more-info">
        <center>
            <div class="head-info">
                <h1>Informasi Kegiatan</h1>
                <br>
                <h4>Kegiatan - kegiatan yang akan dan telah dilaksanakan pada Masjid Ar - Rahmah </h4>
            </div>
        </center>
        <div class="see-more-link">
            <a href="lihat-kegiatan.php">Lihat Lebih</a>
            <img src="img/panahkanan.svg" alt="">
        </div>
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
                            <p><?php echo substr($fetch_data['deskripsi'], 0, 100) ?></p>
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