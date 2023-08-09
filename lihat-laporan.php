<?php
include 'db.php';

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
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

    <div id="laporan-info">
        <div class="back-btn">
            <a href="index.php">
                <img src="img/panahkiri.svg" alt="">
                <p>Kembali</p>
            </a>
        </div>
        <div class="head-info-laporan">
            <h1>Laporan Keuangan</h1>
            <br>
        </div>
        <br><br>
        <div class="laporan-content">
            <form action="" method="POST">
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                    <div class="w-full">
                        <div date-rangepicker class="flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="mulai" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                                dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mulai Tanggal" required>
                            </div>
                            <span class="mx-4 text-gray-500">Ke</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="hingga" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                                 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Hingga Tanggal" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <input type="submit" name="tampilkan" value="Tampilkan" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
                    focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                    inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn">
                    </div>
            </form>
        </div>
        <br><br>
        <?php
        if (isset($_POST['tampilkan'])) {
            $format_mulai = date_create_from_format('m/d/Y', $_POST['mulai']);
            $mulai = $format_mulai->format('Y-m-d');
            $format_hingga = date_create_from_format('m/d/Y', $_POST['hingga']);
            $hingga = $format_hingga->format('Y-m-d');
            $no = 1;
            $saldo = 0;
            $jumlah_masuk = 0;
            $jumlah_keluar = 0;
            $_SESSION['masuk'] = 0;
            $_SESSION['keluar'] = 0;
            $_SESSION['saldo'] = 0;
        ?>
            <!------------------------------TABLE---------------------------------------->
            <div class="h-48 mb-4 ">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 1380px;">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Penanggung Jawab
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pemasukan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pengeluaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Saldo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_data = mysqli_query($conn, "SELECT * FROM laporankeuangan WHERE tanggal BETWEEN '" . $mulai . "' AND '" . $hingga . "' ORDER BY tanggal LIMIT 10");
                            if (mysqli_num_rows($query_data) > 0) {
                                while ($fetch_data = mysqli_fetch_array($query_data)) {
                            ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo $no++ ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $fetch_data['tanggal'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $fetch_data['keterangan'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $fetch_data['penanggungjawab'] ?>
                                        </td>
                                        <?php
                                        if ($fetch_data['jenis'] == 'Pemasukkan') {
                                        ?>
                                            <td class="px-6 py-4 text-teal-600">
                                                <?php echo $fetch_data['nilai'] ?>
                                            </td>
                                            <td>

                                            </td>
                                            <td class="px-6 py-4 text-blue-600">
                                                <?php
                                                $saldo = $saldo + $fetch_data['nilai'];
                                                $jumlah_masuk = $jumlah_masuk + $fetch_data['nilai'];
                                                $_SESSION['masuk'] = $jumlah_masuk;
                                                $_SESSION['saldo'] = $saldo;
                                                echo $saldo;
                                                ?>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td>

                                            </td>
                                            <td class="px-6 py-4 text-red-600">
                                                <?php echo '- ' . $fetch_data['nilai'] ?>
                                            </td>
                                            <td class="px-6 py-4 text-blue-600">
                                                <?php
                                                $saldo = $saldo - $fetch_data['nilai'];
                                                $jumlah_keluar -= $fetch_data['nilai'];
                                                $_SESSION['keluar'] = $jumlah_keluar;
                                                $_SESSION['saldo'] = $saldo;
                                                echo $saldo;
                                                ?>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="px-6 py-3 text-teal-600"><?php echo $_SESSION['masuk'] ?></td>
                                <td class="px-6 py-3 text-red-600"><?php echo $_SESSION['keluar'] ?></td>
                                <td class="px-6 py-3 text-blue-600"><?php echo $_SESSION['saldo'] ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
    <br><br><br><br><br><br>

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