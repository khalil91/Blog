<?php

function guid($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


/**
 * @param string $UPLOAD_DIR
 * @param mysqli|null $conn
 * @return string
 */
function uploadImage(?mysqli $conn): string
{
    $filename = $_FILES['logo']['name'];
    $file = new SplFileInfo($filename);
    $tmp = $_FILES['logo']['tmp_name'];
    $UPLOAD_DIR = dirname(__FILE__, 2) . '\uploads';
    // set the filename as the basename + extension
    $uploaded_file = pathinfo(guid(), PATHINFO_FILENAME) . '.' . $file->getExtension();
    // new file location
    $filepath = $UPLOAD_DIR . '\\' . $uploaded_file;

    // move the file to the upload dir
    move_uploaded_file($tmp, $filepath);

    return mysqli_real_escape_string($conn, 'uploads/' . $uploaded_file);
}
