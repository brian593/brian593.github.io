<?php

define('DIR_LOC', 'images/');
$img = $_POST['img'];
$img = filter_var($img, FILTER_SANITIZE_STRING);
$file_path = DIR_LOC . $img . '.png';
$successful_delete = unlink($file_path);
print $successful_delete ? 'Successfully deleted.' : 'Deletion unsuccessful.';