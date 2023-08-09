<?php
session_start();
include 'db.php';
//Kondisi supaya non user tidak dapat mengakses halaman ini
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kegiatan - Website Masjid Ar-Rahmah</title>
    <!--------------------Font Inter-------------------------------------------->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!--------------------CSS-------------------------------------------->
    <link rel="stylesheet" href="css/style-admin.css">
    <!--------------------Flowbite-------------------------------------------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <!--------------------- Sweet Alert CDN ----------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .save-btn {
            display: flex;
            justify-content: flex-end;
            margin-top: 3em;
            align-items: center;
            gap: 5em;
        }

        .save-btn input {
            width: 200px;
        }

        .mini-nav {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            margin-top: 2em;
        }

        .mini-nav .nav-part {
            display: flex;
            flex-direction: row;
            gap: 1em;
        }
    </style>
</head>

<body>
    <!--------------------------------------------ADMIN-------------------------------------------------------->
    <?php
    if ($_SESSION['role_login'] == 'admin') {
    ?>
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                            </svg>
                        </button>
                        <a href="dashboard.php" class="flex ml-2 md:mr-24">
                            <img src="img/logo-small.jpg" class="h-8 mr-3" alt="FlowBite Logo" />
                            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Masjid Ar - Rahmah</span>
                        </a>
                    </div>
                    <div class="flex items-center" style="gap: 1em; align-items:center;">
                        <div class="flex items-center ml-3">
                            <div>
                                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        <?php echo $_SESSION['name'] ?>
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        <?php echo $_SESSION['role_login'] ?>
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="separator">
                            <img src="img/separator.png" alt="" style="width: 1px;height: 43px;">
                        </div>
                        <div class="logout-btn">
                            <a href="logout.php">
                                <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Log Out</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="pemasukkan.php" class="flex items-center p-2 text-gray-700 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                <path d="M14.067 0H7v5a2 2 0 0 1-2 2H0v4h7.414l-1.06-1.061a1 1 0 1 1 1.414-1.414l2.768 2.768a1 1 0 0 1 0 1.414l-2.768 2.768a1 1 0 0 1-1.414-1.414L7.414 13H0v5a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.933-2Z" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Pemasukkan</span>
                        </a>
                    </li>
                    <li>
                        <a href="pengeluaran.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                                <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Pengeluaran</span>
                        </a>
                    </li>
                    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="laporan.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v2H7V2ZM5 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 4H8a1 1 0 0 1 0-2h5a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                            </a>
                        </li>
                        <li>
                            <a href="asset.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Aset Masjid</span>
                            </a>
                        </li>
                        <li>
                            <a href="kegiatan.php" class="flex items-center p-2 text-gray-900 rounded-lg bg-gray-100 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 21">
                                    <path d="m5.4 2.736 3.429 3.429A5.046 5.046 0 0 1 10.134 6c.356.01.71.06 1.056.147l3.41-3.412c.136-.133.287-.248.45-.344A9.889 9.889 0 0 0 10.269 1c-1.87-.041-3.713.44-5.322 1.392a2.3 2.3 0 0 1 .454.344Zm11.45 1.54-.126-.127a.5.5 0 0 0-.706 0l-2.932 2.932c.029.023.049.054.078.077.236.194.454.41.65.645.034.038.078.067.11.107l2.927-2.927a.5.5 0 0 0 0-.707Zm-2.931 9.81c-.024.03-.057.052-.081.082a4.963 4.963 0 0 1-.633.639c-.041.036-.072.083-.115.117l2.927 2.927a.5.5 0 0 0 .707 0l.127-.127a.5.5 0 0 0 0-.707l-2.932-2.931Zm-1.442-4.763a3.036 3.036 0 0 0-1.383-1.1l-.012-.007a2.955 2.955 0 0 0-1-.213H10a2.964 2.964 0 0 0-2.122.893c-.285.29-.509.634-.657 1.013l-.01.016a2.96 2.96 0 0 0-.21 1 2.99 2.99 0 0 0 .489 1.716c.009.014.022.026.032.04a3.04 3.04 0 0 0 1.384 1.1l.012.007c.318.129.657.2 1 .213.392.015.784-.05 1.15-.192.012-.005.02-.013.033-.018a3.011 3.011 0 0 0 1.676-1.7v-.007a2.89 2.89 0 0 0 0-2.207 2.868 2.868 0 0 0-.27-.515c-.007-.012-.02-.025-.03-.039Zm6.137-3.373a2.53 2.53 0 0 1-.35.447L14.84 9.823c.112.428.166.869.16 1.311-.01.356-.06.709-.147 1.054l3.413 3.412c.132.134.249.283.347.444A9.88 9.88 0 0 0 20 11.269a9.912 9.912 0 0 0-1.386-5.319ZM14.6 19.264l-3.421-3.421c-.385.1-.781.152-1.18.157h-.134c-.356-.01-.71-.06-1.056-.147l-3.41 3.412a2.503 2.503 0 0 1-.443.347A9.884 9.884 0 0 0 9.732 21H10a9.9 9.9 0 0 0 5.044-1.388 2.519 2.519 0 0 1-.444-.348ZM1.735 15.6l3.426-3.426a4.608 4.608 0 0 1-.013-2.367L1.735 6.4a2.507 2.507 0 0 1-.35-.447 9.889 9.889 0 0 0 0 10.1c.1-.164.217-.316.35-.453Zm5.101-.758a4.957 4.957 0 0 1-.651-.645c-.033-.038-.077-.067-.11-.107L3.15 17.017a.5.5 0 0 0 0 .707l.127.127a.5.5 0 0 0 .706 0l2.932-2.933c-.03-.018-.05-.053-.078-.076ZM6.08 7.914c.03-.037.07-.063.1-.1.183-.22.384-.423.6-.609.047-.04.082-.092.129-.13L3.983 4.149a.5.5 0 0 0-.707 0l-.127.127a.5.5 0 0 0 0 .707L6.08 7.914Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Informasi Kegiatan</span>
                            </a>
                        </li>
                    </ul>
            </div>
        </aside>
        <!--------------------------------------------MASTERADMIN-------------------------------------------------------->
    <?php
    } else if ($_SESSION['role_login'] == 'masteradmin') {
    ?>
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                            </svg>
                        </button>
                        <a href="dashboard.php" class="flex ml-2 md:mr-24">
                            <img src="img/logo-small.jpg" class="h-8 mr-3" alt="FlowBite Logo" />
                            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Masjid Ar - Rahmah</span>
                        </a>
                    </div>
                    <div class="flex items-center" style="gap: 1em; align-items:center;">
                        <div class="flex items-center ml-3">
                            <div>
                                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        <?php echo $_SESSION['name'] ?>
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        <?php echo $_SESSION['role_login'] ?>
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="separator">
                            <img src="img/separator.png" alt="" style="width: 1px;height: 43px;">
                        </div>
                        <div class="logout-btn">
                            <a href="logout.php">
                                <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Log Out</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="pemasukkan.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                <path d="M14.067 0H7v5a2 2 0 0 1-2 2H0v4h7.414l-1.06-1.061a1 1 0 1 1 1.414-1.414l2.768 2.768a1 1 0 0 1 0 1.414l-2.768 2.768a1 1 0 0 1-1.414-1.414L7.414 13H0v5a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.933-2Z" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Pemasukkan</span>
                        </a>
                    </li>
                    <li>
                        <a href="pengeluaran.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                                <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Pengeluaran</span>
                        </a>
                    </li>
                    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="laporan.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v2H7V2ZM5 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 4H8a1 1 0 0 1 0-2h5a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                            </a>
                        </li>
                        <li>
                            <a href="asset.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Aset Masjid</span>
                            </a>
                        </li>
                        <li>
                            <a href="kegiatan.php" class="flex items-center p-2 text-gray-900 bg-gray-100 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 21">
                                    <path d="m5.4 2.736 3.429 3.429A5.046 5.046 0 0 1 10.134 6c.356.01.71.06 1.056.147l3.41-3.412c.136-.133.287-.248.45-.344A9.889 9.889 0 0 0 10.269 1c-1.87-.041-3.713.44-5.322 1.392a2.3 2.3 0 0 1 .454.344Zm11.45 1.54-.126-.127a.5.5 0 0 0-.706 0l-2.932 2.932c.029.023.049.054.078.077.236.194.454.41.65.645.034.038.078.067.11.107l2.927-2.927a.5.5 0 0 0 0-.707Zm-2.931 9.81c-.024.03-.057.052-.081.082a4.963 4.963 0 0 1-.633.639c-.041.036-.072.083-.115.117l2.927 2.927a.5.5 0 0 0 .707 0l.127-.127a.5.5 0 0 0 0-.707l-2.932-2.931Zm-1.442-4.763a3.036 3.036 0 0 0-1.383-1.1l-.012-.007a2.955 2.955 0 0 0-1-.213H10a2.964 2.964 0 0 0-2.122.893c-.285.29-.509.634-.657 1.013l-.01.016a2.96 2.96 0 0 0-.21 1 2.99 2.99 0 0 0 .489 1.716c.009.014.022.026.032.04a3.04 3.04 0 0 0 1.384 1.1l.012.007c.318.129.657.2 1 .213.392.015.784-.05 1.15-.192.012-.005.02-.013.033-.018a3.011 3.011 0 0 0 1.676-1.7v-.007a2.89 2.89 0 0 0 0-2.207 2.868 2.868 0 0 0-.27-.515c-.007-.012-.02-.025-.03-.039Zm6.137-3.373a2.53 2.53 0 0 1-.35.447L14.84 9.823c.112.428.166.869.16 1.311-.01.356-.06.709-.147 1.054l3.413 3.412c.132.134.249.283.347.444A9.88 9.88 0 0 0 20 11.269a9.912 9.912 0 0 0-1.386-5.319ZM14.6 19.264l-3.421-3.421c-.385.1-.781.152-1.18.157h-.134c-.356-.01-.71-.06-1.056-.147l-3.41 3.412a2.503 2.503 0 0 1-.443.347A9.884 9.884 0 0 0 9.732 21H10a9.9 9.9 0 0 0 5.044-1.388 2.519 2.519 0 0 1-.444-.348ZM1.735 15.6l3.426-3.426a4.608 4.608 0 0 1-.013-2.367L1.735 6.4a2.507 2.507 0 0 1-.35-.447 9.889 9.889 0 0 0 0 10.1c.1-.164.217-.316.35-.453Zm5.101-.758a4.957 4.957 0 0 1-.651-.645c-.033-.038-.077-.067-.11-.107L3.15 17.017a.5.5 0 0 0 0 .707l.127.127a.5.5 0 0 0 .706 0l2.932-2.933c-.03-.018-.05-.053-.078-.076ZM6.08 7.914c.03-.037.07-.063.1-.1.183-.22.384-.423.6-.609.047-.04.082-.092.129-.13L3.983 4.149a.5.5 0 0 0-.707 0l-.127.127a.5.5 0 0 0 0 .707L6.08 7.914Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Informasi Kegiatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="kelola-admin.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                    <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                    <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Kelola Akun</span>
                            </a>
                        </li>
                    </ul>
            </div>
        </aside>
    <?php
    }
    ?>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-3 gap-4">
                <h2 class="text-4xl font-bold dark:text-white" style="margin-top: 1em;">Informasi</h2>
            </div>
            <div class="mini-nav">
                <div class="nav-part">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10.5C18 12.6217 17.1571 14.6566 15.6569 16.1569C14.1566 17.6571 12.1217 18.5 10 18.5C7.87827 18.5 5.84344 17.6571 4.34315 16.1569C2.84285 14.6566 2 12.6217 2 10.5C2 8.37827 2.84285 6.34344 4.34315 4.84315C5.84344 3.34285 7.87827 2.5 10 2.5C12.1217 2.5 14.1566 3.34285 15.6569 4.84315C17.1571 6.34344 18 8.37827 18 10.5ZM16 10.5C16 11.493 15.759 12.429 15.332 13.254L13.808 11.729C14.0362 11.0227 14.0632 10.2668 13.886 9.546L15.448 7.984C15.802 8.749 16 9.6 16 10.5ZM10.835 14.413L12.415 15.993C11.654 16.3281 10.8315 16.5007 10 16.5C9.13118 16.5011 8.27257 16.3127 7.484 15.948L9.046 14.386C9.63267 14.5298 10.2443 14.539 10.835 14.413ZM6.158 11.617C5.96121 10.9394 5.94707 10.2218 6.117 9.537L6.037 9.617L4.507 8.084C4.1718 8.84531 3.99913 9.66817 4 10.5C4 11.454 4.223 12.356 4.619 13.157L6.159 11.617H6.158ZM7.246 5.167C8.09722 4.72702 9.04179 4.49825 10 4.5C10.954 4.5 11.856 4.723 12.657 5.119L11.117 6.659C10.3493 6.43538 9.53214 6.44687 8.771 6.692L7.246 5.168V5.167ZM12 10.5C12 11.0304 11.7893 11.5391 11.4142 11.9142C11.0391 12.2893 10.5304 12.5 10 12.5C9.46957 12.5 8.96086 12.2893 8.58579 11.9142C8.21071 11.5391 8 11.0304 8 10.5C8 9.96957 8.21071 9.46086 8.58579 9.08579C8.96086 8.71071 9.46957 8.5 10 8.5C10.5304 8.5 11.0391 8.71071 11.4142 9.08579C11.7893 9.46086 12 9.96957 12 10.5Z" fill="#374151" />
                    </svg>
                    <a href="kegiatan.php">Informasi Kegiatan</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29279 15.2069C7.10532 15.0194 7 14.7651 7 14.4999C7 14.2348 7.10532 13.9804 7.29279 13.7929L10.5858 10.4999L7.29279 7.20692C7.11063 7.01832 7.00983 6.76571 7.01211 6.50352C7.01439 6.24132 7.11956 5.99051 7.30497 5.8051C7.49038 5.61969 7.74119 5.51452 8.00339 5.51224C8.26558 5.50997 8.51818 5.61076 8.70679 5.79292L12.7068 9.79292C12.8943 9.98045 12.9996 10.2348 12.9996 10.4999C12.9996 10.7651 12.8943 11.0194 12.7068 11.2069L8.70679 15.2069C8.51926 15.3944 8.26495 15.4997 7.99979 15.4997C7.73462 15.4997 7.48031 15.3944 7.29279 15.2069Z" fill="#9CA3AF" />
                    </svg>
                    <p>Tambah Kegiatan</p>
                </div>
            </div>
            <br><br>
            <div class=" h-48 mb-4 rounded">
                <section class="bg-white dark:bg-gray-900">
                    <div class="">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div id="form-part">
                                <div class="left-part">
                                    <div class="">
                                        <label for="activity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Nama Kegiatan</label>
                                        <input type="text" name="activity_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nama Kegiatan" required="">
                                    </div>
                                    <div class="w-full">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Tanggal</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker datepicker-autohide type="text" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Upload Photo</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                                     cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 
                                     dark:border-gray-600 dark:placeholder-gray-400" name="images[]" id="file_input" type="file" multiple required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Upload File</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                                     cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 
                                     dark:border-gray-600 dark:placeholder-gray-400" name="addfile" id="file_input" type="file" required>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div>
                                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Keterangan</label>
                                        <textarea id="message" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Keterangan Tambahan"></textarea>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="font-weight: bolder;">Penanggung Jawab</label>
                                        <input name="organizer" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                         focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                         dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Personel Penanggung Jawab Kegiatan" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="save-btn">
                                <button id="cancel" onclick="cancel_form()">Cancel</button>
                                <input type="submit" name="submit" value="Simpan" class=" text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            </div>
                        </form>
                    </div>
                </section>
                <br><br>

                <script>
                    function cancel_form() {
                        window.location.href = 'kegiatan.php';
                    }
                </script>


                <!-- <?php
                        if (isset($_POST['submit'])) {
                            //Menampung data dari form 
                            $id = rand();
                            $namakegiatan = addslashes($_POST['activity_name']);
                            //mengubah format tanggal supaya bisa diterima MySQL
                            $format_tanggal = date_create_from_format('m/d/Y', $_POST['date']);
                            $tanggal = $format_tanggal->format('Y-m-d');
                            $pjawab = $_POST['organizer'];
                            $deskripsi = $_POST['message'];

                            //Menampung file yang diupload
                            $filename = $_FILES['addfile']['name'];
                            $tmp_file = $_FILES['addfile']['tmp_name'];

                            $picname = $_FILES['addpic']['name'];
                            $tmp_pic = $_FILES['addpic']['tmp_name'];

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $type3 = explode('.', $picname);
                            $type4 = $type3[1];

                            //rename file dokumen
                            $newfile = 'dokumen' . $id . '.' . $type2;

                            //rename file data gambar
                            $newpic = 'gambar' . $id . '.' . $type4;

                            //menampung data format file yang diizinkan
                            $tipe_gambar_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                            if (!in_array($type4, $tipe_gambar_diizinkan)) {
                                echo '<script>alert("Format file tidak diizinkan")</script>';
                            } else {
                                //Memasukkan data gambar dan dokumen kedalam folder yang ditentukan
                                move_uploaded_file($tmp_pic, './kegiatan/' . $newpic);
                                move_uploaded_file($tmp_file, './dokumen/' . $newfile);
                                $input_data = mysqli_query($conn, "INSERT INTO informasikegiatan VALUE (
                                        '" . $id . "',
                                        '" . $namakegiatan . "',
                                        '" . $tanggal . "',
                                        '" . $newpic . "',
                                        '" . $newfile . "',
                                        '" . $deskripsi . "',
                                        '" . $pjawab . "'
                                    )");
                                if ($input_data) {
                                    echo '<script>Swal.fire({
                                            title: "Berhasil Tambah Kegiatan",
                                            text: "Klik OK Untuk Lanjut",
                                            icon: "success"
                                          }).then(function() {
                                            window.location = "kegiatan.php";
                                          });
                                        </script>';
                                }
                            }
                        }
                        ?> -->
            </div>

            <?php
            if (isset($_POST['submit'])) {

                $images = $_FILES['images'];
                $id = rand();
                $namakegiatan = addslashes($_POST['activity_name']);
                //mengubah format tanggal supaya bisa diterima MySQL
                $format_tanggal = date_create_from_format('m/d/Y', $_POST['date']);
                $tanggal = $format_tanggal->format('Y-m-d');
                $pjawab = $_POST['organizer'];
                $deskripsi = addslashes($_POST['deskripsi']);

                //Menampung file yang diupload
                $filename = $_FILES['addfile']['name'];
                $tmp_file = $_FILES['addfile']['tmp_name'];

                $type1 = explode('.', $filename);
                $type2 = $type1[1];

                //rename file dokumen
                $newfile = 'dokumen' . $id . '.' . $type2;

                //Memasukkan data dokumen kedalam folder yang ditentukan
                move_uploaded_file($tmp_file, './dokumen/' . $newfile);
                $input_data = mysqli_query($conn, "INSERT INTO 
                            informasikegiatan VALUE (
                                '" . $id . "',
                                '" . $namakegiatan . "',
                                '" . $tanggal . "',
                                NULL,
                                '" . $newfile . "',
                                '" . $deskripsi . "',
                                '" . $pjawab . "'
                            )");

                # Number of images
                $num_of_imgs = count($images['name']);

                for ($i = 0; $i < $num_of_imgs; $i++) {

                    # get the image info and store them in var
                    $image_name = $images['name'][$i];
                    $tmp_name   = $images['tmp_name'][$i];
                    $error      = $images['error'][$i];

                    # if there is not error occurred while uploading
                    if ($error === 0) {

                        # get image extension store it in var
                        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);

                        /* 
                        convert the image extension into lower case 
                        and store it in var 
                         */
                        $img_ex_lc = strtolower($img_ex);

                        /* 
                        crating array that stores allowed
                        to upload image extensions.
                         */
                        $allowed_exs = array('jpg', 'jpeg', 'png');


                        /* 
                        check if the the image extension 
                        is present in $allowed_exs array
                         */

                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $id_gambar = rand();
                            /* 
                             renaming the image name with 
                             with random string
                             */
                            $new_img_name = uniqid('Foto-', true) . '.' . $img_ex_lc;

                            # crating upload path on root directory
                            $img_upload_path = 'kegiatan/' . $new_img_name;

                            # inserting imge name into database

                            $input_gambar_db = mysqli_query($conn, "INSERT INTO gambarkegiatan 
                            VALUE (
                               '" . $id_gambar . "',
                               '" . $id . "',
                               '" . $new_img_name . "'
                            )");

                            # move uploaded image to 'uploads' folder
                            move_uploaded_file($tmp_name, $img_upload_path);
                        } else {
                            # error message
                            $em = "Tidak bisa mengupload file selain gambar";

                            /*
                            redirect to 'index.php' and 
                            passing the error message
                            */

                            header("Location: tambah-kegiatan.php?error=$em");
                        }
                    } else {
                        # error message
                        $em = "Terjadi Kesalahan dalam mengunggah file";

                        /*
                        redirect to 'index.php' and 
                        passing the error message
                        */

                        header("Location: tambah-kegiatan.php?error=$em");
                    }
                }
                echo '<script>Swal.fire({
                    title: "Berhasil Tambah Kegiatan",
                    text: "Klik OK Untuk Lanjut",
                    icon: "success"
                  }).then(function() {
                    window.location = "kegiatan.php";
                  });
                </script>';
            }

            ?>

        </div>
    </div>
</body>

</html>