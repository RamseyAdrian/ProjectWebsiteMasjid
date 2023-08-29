<?php
include 'db.php';

$get_year = date("Y");
$get_month_string = date("F");
$get_month = date("m");
$month_str = strval($get_month);

$query_kegiatan = mysqli_query($conn, "SELECT * FROM informasikegiatan ORDER BY tanggal LIMIT 3");
$query_bulan = mysqli_query($conn, "SELECT * FROM grafikpemasukan WHERE tahun = '" . $get_year . "' ");
$query_nilai = mysqli_query($conn, "SELECT * FROM grafikpemasukan WHERE tahun = '" . $get_year . "' ");
$query_keterangan = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE tahun = '" . $get_year . "' AND bulan = '" . $month_str . "' ");
$query_nilai2 = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE tahun = '" . $get_year . "' AND bulan = '" . $month_str . "' ");

$query_saldo = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE id = '" . $get_year . "' ");
$fetch_saldo = mysqli_fetch_array($query_saldo);
$saldo = $fetch_saldo['nilai'];
$ket_saldo = $fetch_saldo['keterangan'];

function bulan_indo($par)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    return $bulan[(int)$par];
}
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
    <!--------------------JQuery-------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!--------------------ChartJs-------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.jpg" alt="">
            </a>
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



    <div id="report-info">
        <div class="more-report-link">
            <a href="lihat-laporan.php">Lihat Laporan Keuangan</a>
            <img src="img/panahkanan.svg" alt="">
        </div>
        <div class="report-content">
            <div class="pemasukkan">
                <div class="heading">
                    <div class="text-part">
                        <h3>Pemasukkan Tahun <?php echo $get_year ?></h3>
                    </div>
                </div>
                <div class="graph">
                    <canvas id="bar-pemasukkan">
                    </canvas>
                </div>
            </div>
            <div class="perbandingan">
                <div class="heading">
                    <div class="text-part">
                        <h3>Perbandingan Keuangan Bulan <?php echo bulan_indo($get_month) . " " . $get_year ?></h3>
                    </div>
                </div>
                <div class="graph">
                    <canvas id="bar-perbandingan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var graph_pemasukkan = document.getElementById('bar-pemasukkan').getContext("2d");
        var data = {
            labels: [<?php while ($bulan = mysqli_fetch_array($query_bulan)) {
                            echo '"' . $bulan['namabulan'] . '",';
                        } ?>],
            datasets: [{
                label: "Pemasukkan Tahunan",
                data: [<?php while ($nilai = mysqli_fetch_array($query_nilai)) {
                            echo '"' . $nilai['nilai'] . '",';
                        } ?>],
                backgroundColor: [
                    '#05934A'

                ]
            }]
        };

        var barChartPemasukan = new Chart(document.getElementById('bar-pemasukkan'), {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    legend: false // Hide legend
                },
                barValueSpacing: 20,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
            }
        });

        var graph_perbandingan = document.getElementById("bar-perbandingan").getContext("2d");
        var data_perbandingan = {
            labels: [<?php while ($ket = mysqli_fetch_array($query_keterangan)) {
                            echo '"' . $ket['keterangan'] . '",';
                        }
                        echo '"' . $ket_saldo . '",' ?>],
            datasets: [{
                label: "Perbandingan Keuangan",
                data: [<?php while ($nilai2 = mysqli_fetch_array($query_nilai2)) {
                            echo '"' . $nilai2['nilai'] . '",';
                        }
                        echo '"' . $saldo . '",' ?>],
                backgroundColor: [
                    '#05934A',
                    '#F05252',
                    '#FFB356'

                ]
            }]
        };

        var barChartPerbandingan = new Chart(graph_perbandingan, {
            type: 'bar',
            data: data_perbandingan,
            options: {
                plugins: {
                    legend: false // Hide legend
                },
                indexAxis: 'y',
                barValueSpacing: 20,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }],
                    x: {
                        display: false // Hide X axis labels
                    }
                }
            }
        });
    </script>

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
                            <a href="detail-kegiatan.php?id=<?php echo $fetch_data['id_kegiatan'] ?>"><button id="read-more-btn">Read More</button></a>
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