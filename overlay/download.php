<?php
//session_start();
//include_once(__DIR__.'/vendor/autoload.php');

// $user_id = $_POST['id'];
// $img = __DIR__.'/generated/'.$user_id.'.jpg';
//
// $token;
//
// if( !empty($_SESSION['access_token']) ){
//   $token = $_SESSION['access_token'];
// }
//
// $fb = new \Facebook\Facebook([
//   'app_id' => '1910308689210699',
//   'app_secret' => '690c7c65992670ca621973c55efb3ee4',
//   'default_graph_version' => 'v2.9',
//   //'default_access_token' => '{access-token}', // optional
// ]);
function download($url, $name) {
    set_time_limit(0);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $r = curl_exec($ch);
    curl_close($ch);
    header('Expires: 0'); // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
    header('Cache-Control: private', false);
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename="' . $name . '.jpg"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . strlen($r)); // provide file size
    header('Connection: close');
    echo $r;
}

if( !empty( $_GET['id'] ) ){

  $url = "http://www.virtualrival.mainsusl.com/image.php?id=" . $_GET['id'];
  download($url, "name");

}

unlink( __DIR__.'/generated/'.$_GET['id'].'.jpg' );


?>
