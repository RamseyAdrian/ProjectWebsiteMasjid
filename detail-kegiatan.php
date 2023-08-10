<?php
include 'db.php';

$query_kegiatan = mysqli_query($conn, "SELECT * FROM informasikegiatan WHERE id_kegiatan = '" . $_GET['id'] . "' ");
$query_pic = mysqli_query($conn, "SELECT * FROM gambarkegiatan WHERE id_kegiatan = '" . $_GET['id'] . "' LIMIT 1 ");
$query_gambar = mysqli_query($conn, "SELECT * FROM gambarkegiatan WHERE id_kegiatan = '" . $_GET['id'] . "' LIMIT 4 ");
$fetch_data = mysqli_fetch_array($query_kegiatan);
$fetch_pic = mysqli_fetch_array($query_pic);
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
            <a href="lihat-kegiatan.php">
                <img src="img/panahkiri.svg" alt="">
                <p>Kembali</p>
            </a>
        </div>
        <div class="head-info-kegiatan">
            <h1><?php echo $fetch_data['namakegiatan'] ?></h1>
            <br>
        </div>
        <div class="head-info-2">
            <div class="date">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C5.73478 2 5.48043 2.10536 5.29289 2.29289C5.10536 2.48043 5 2.73478 5 3V4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V16C2 16.5304 2.21071 17.0391 2.58579 17.4142C2.96086 17.7893 3.46957 18 4 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0391 18 16.5304 18 16V6C18 5.46957 17.7893 4.96086 17.4142 4.58579C17.0391 4.21071 16.5304 4 16 4H15V3C15 2.73478 14.8946 2.48043 14.7071 2.29289C14.5196 2.10536 14.2652 2 14 2C13.7348 2 13.4804 2.10536 13.2929 2.29289C13.1054 2.48043 13 2.73478 13 3V4H7V3C7 2.73478 6.89464 2.48043 6.70711 2.29289C6.51957 2.10536 6.26522 2 6 2ZM6 7C5.73478 7 5.48043 7.10536 5.29289 7.29289C5.10536 7.48043 5 7.73478 5 8C5 8.26522 5.10536 8.51957 5.29289 8.70711C5.48043 8.89464 5.73478 9 6 9H14C14.2652 9 14.5196 8.89464 14.7071 8.70711C14.8946 8.51957 15 8.26522 15 8C15 7.73478 14.8946 7.48043 14.7071 7.29289C14.5196 7.10536 14.2652 7 14 7H6Z" fill="#1F2A37" />
                </svg>
                <p><?php echo $fetch_data['tanggal'] ?></p>
            </div>
            <div class="person">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 9C10.7956 9 11.5587 8.68393 12.1213 8.12132C12.6839 7.55871 13 6.79565 13 6C13 5.20435 12.6839 4.44129 12.1213 3.87868C11.5587 3.31607 10.7956 3 10 3C9.20435 3 8.44129 3.31607 7.87868 3.87868C7.31607 4.44129 7 5.20435 7 6C7 6.79565 7.31607 7.55871 7.87868 8.12132C8.44129 8.68393 9.20435 9 10 9ZM3 18C3 17.0807 3.18106 16.1705 3.53284 15.3212C3.88463 14.4719 4.40024 13.7003 5.05025 13.0503C5.70026 12.4002 6.47194 11.8846 7.32122 11.5328C8.1705 11.1811 9.08075 11 10 11C10.9193 11 11.8295 11.1811 12.6788 11.5328C13.5281 11.8846 14.2997 12.4002 14.9497 13.0503C15.5998 13.7003 16.1154 14.4719 16.4672 15.3212C16.8189 16.1705 17 17.0807 17 18H3Z" fill="#1F2A37" />
                </svg>
                <p> <?php echo $fetch_data['penanggungjawab'] ?></p>
            </div>
        </div>
        <br><br>
        <div class="kegiatan-content">
            <div class="text-section">
                <p>
                    <?php echo $fetch_data['deskripsi'] ?>
                </p>
            </div>
            <div class="image-section">
                <div class="image-box">
                    <img src="kegiatan/<?php echo $fetch_pic['namagambar'] ?>" alt="">
                </div>
            </div>
        </div>
        <br><br>
        <div class="more-picture">
            <?php
            while ($fetch_gambar = mysqli_fetch_array($query_gambar)) {
            ?>
                <div class="pic-box">
                    <img src="kegiatan/<?php echo $fetch_gambar['namagambar'] ?>" alt="">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br><br>

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