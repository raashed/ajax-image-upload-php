<?php
/**
 * Created by Mohammad Rashedul Islam.
 * User: Raashed
 * Date: 8/10/2017
 * Time: 21:07
 */
$response = '';

$allowed_extensions = ['gif', 'jpeg', 'jpg', 'png'];
$temporary = explode('.', $_FILES['file']['name']);
$extension = end($temporary);
$max_size = 200000;

if (
    (  ($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/x-png")  )
    && ($_FILES["file"]["size"] < $max_size)
    && in_array($extension, $allowed_extensions) )
{
    if ($_FILES['file']['error'] > 0)
    {
        $response = $_FILES['file']['error'];
    }
    else
    {
        if (file_exists("uploads/" . $_FILES['file']['name']))
        {
            $response = $_FILES['file']['name'] . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
            $response = 'Upload success';
        }
    }
}
else
{
    $response = 'Invalid file';
}

echo json_encode($response);
