<?php
session_start();
include_once(__DIR__.'/vendor/autoload.php');

$user_id = $_GET['id'];
$file_path = __DIR__.'/generated/'.$user_id.'.jpg';

if( !empty( $user_id ) && file_exists($file_path) ){
  header('Content-Type: image/jpeg');
  echo file_get_contents($file_path);
  exit;
}

$token;

if( !empty($_SESSION['access_token']) ){
  $token = $_SESSION['access_token'];
}

$fb = new \Facebook\Facebook([
  'app_id' => '819360642543487',
  'app_secret' => '67d2ab2394dcf849e67d37d5b16eddbc',
  'default_graph_version' => 'v2.9',
  //'default_access_token' => '{access-token}', // optional
]);

if( !empty($token) ){
  $response = $fb->get('/me?fields=id,name,picture.width(600).height(600)', $token);

  $me = $response->getGraphUser();
  $pic =  $me->getPicture();
  $url = $pic->getUrl();

  header('Content-Type: image/jpeg');
  $imageContent = file_get_contents($url);
  $src = imagecreatefromstring($imageContent);
  $srcScaled = imagescale($src, 600, 600);

  $overlayFilePath = __DIR__.'/images/fb.png';
  $overlay = imagecreatefrompng($overlayFilePath); // 600x600

  //Draw
  imagecopy($srcScaled, $overlay, 0, 0, 0, 0, 600, 600);
  imagejpeg($srcScaled, __DIR__.'/generated/'.$me->getId().'.jpg' );
  imagejpeg($srcScaled);

  imagedestroy($src);
  imagedestroy($srcScaled);
  imagedestroy($overlay);
}
//header('Content-Type: image/jpeg');



 ?>
