<?php
date_default_timezone_set('Asia/Jakarta'); // SET WIB
$conn = mysqli_connect("localhost", "root", "", "bertanya");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
}

function upload_file()
{
    $namaFile = $_FILES['file_belajar']['name'];
    $ukuranFile = $_FILES['file_belajar']['size'];
    $error = $_FILES['file_belajar']['error'];
    $tmpName = $_FILES['file_belajar']['tmp_name'];

    // Jika file tidak diunggah, kembalikan nilai NULL
    if ($error === UPLOAD_ERR_NO_FILE) {
        return NULL;
    }

    // Batas ukuran file adalah 3 megabyte (MB)
    $maxSize = 3 * 1024 * 1024;

    // Jika ukuran file melebihi batas maksimum
    if ($ukuranFile > $maxSize) {
        echo "<script>alert('File melebihi 3MB!');</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/file-data/' . $namaFileBaru);

    return $namaFileBaru;
}