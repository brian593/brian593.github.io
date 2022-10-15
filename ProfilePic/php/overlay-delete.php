<?php

define('DIR_LOC', '../images/');
$img = filter_input($_POST['img'], FILTER_SANITIZE_STRING);
$file_path = DIR_LOC . img . '.png';
$successful_delete = unlink($file);
print $successful_delete ? 'Successfully deleted.' : 'Deletion unsuccessful.';