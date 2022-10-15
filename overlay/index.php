<?php
session_start();
include_once(__DIR__.'/vendor/autoload.php');

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

 ?>
<!DOCTYPE html>
<html lang="en">

  <head>
<style>
.button {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #b2beb5;//#333333
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
</style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><h1></h1>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show your support for Virtual Rival 2K17 </title>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  </body>


<?php
$bg_path = "images/bg1.jpeg";//new
if( empty($token) ){

  $helper = $fb->getRedirectLoginHelper();

  $permissions = ['public_profile', 'email', 'user_friends', 'publish_actions']; // optional
  $callback = 'brian593.github.io';
  $loginUrl = $helper->getLoginUrl($callback, $permissions);

  echo '<body>';
  echo '<img src="images/bg1.jpeg" class="bg">';
  echo '<div class="container">';
  echo '<div class="row">';

    echo '<div class="header">';
    echo '<h1>Show your support for Virtual Rival</h1>';
    echo '<img class="profile" src="images/photo.jpg"/>';
    echo '</div>';
    echo '<div class="content">';
    echo '<br/>';
    echo '<p>Show your support for Virtual Rival by updating your facebook picture. </p>';
    echo '<a class="button button-primary" href='.$loginUrl.' > Log in to Facebook </a>';
    echo '</div>';

    echo 'Spread the world:';
    echo  '<ul class="share-buttons">';
    echo '<li>';
    echo  '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.virtualrival.mainsusl.com" title="Share on Facebook" target="_blank">';
    echo  '<img src="images/simple_icons_black/Facebook.png">';
    echo '</a>';
    echo '</li>';
    echo '<li>';
    echo  '<a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&text=Show%20your%20support%20for%20Virtual%20Rival:%20http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&" target="_blank" title="Tweet">';
    echo  '<img src="images/simple_icons_black/Twitter.png">';
    echo '</a>';
    echo '</li>';
    echo '<li>';
    echo '<a href="http://www.reddit.com/submit?url=http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&title=Show%20your%20support%20for%20Virtual%20Rival" target="_blank" title="Submit to Reddit"><img src="images/simple_icons_black/Reddit.png">';
    echo '</a>';
    echo '</li>';
    echo '<li>';
    echo  '<a href="mailto:?subject=Show%20your%20support%20for%20Virtual%20Rival&body=Let%20us%20show%20our%20support%20for%20Virtual%20Rival%20by%20changing%20our%20facebook%20profile%20picture:%20http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F" target="_blank" title="Email">';
    echo  '<img src="images/simple_icons_black/Email.png">';
    echo '</a>';
    echo '</li>';
    echo '</ul>';



    echo '</div>';
    echo '</div>';

  echo '</body>';


  //echo '<a href="'.$loginUrl.'" class="button button-primary"> Log in to Facebook </a>';
  //echo '<a href="'.$loginUrl.'"><input type="button" class="button button-primary" value="Log in with Facebook!"></a>';//<button class="loginBtn loginBtn--facebook">Login with Facebook</button>
  //<a href=""><input type="button" class="buy" value="Buy Now"></a>
}else{

  try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me?fields=id,name,picture.width(600).height(600)', $token);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
$pic =  $me->getPicture();
//echo 'Logged in as ' . $me->getName(), '<br/>Picture : ', $pic->getUrl();
echo '<body>';
echo '<img src="images/bg1.jpeg" class="bg">';
echo '<div class="container">';
echo '<div class="row">';

  echo '<div class="header">';
  echo '<h1>Your new profile picture is ready !</h1>';
  echo '<img class="profile" src="image.php?id='.$me->getId().'" style="height:500px;width:500px"/>';
  echo '</div>';
  echo '<br/>';
  echo '<a class="button" href="download.php?id='.$me->getId().'" >Download</a>';
  echo '<div class="content">';
  echo '<br/>';

  ?>

  <form method="POST" action="upload.php">
      <input type="hidden" name="id" value="<?php echo $me->getId() ?>" />
      <input type="submit" value="Upload to Facebook" />

  </form>


  <?php

  echo 'Spread the word:';
  echo  '<ul class="share-buttons">';
  echo '<li>';
  echo  '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.virtualrival.mainsusl.com" title="Share on Facebook" target="_blank">';
  echo  '<img src="images/simple_icons_black/Facebook.png">';
  echo '</a>';
  echo '</li>';
  echo '<li>';
  echo  '<a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&text=Show%20your%20support%20for%20Virtual%20Rival:%20http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&" target="_blank" title="Tweet">';
  echo  '<img src="images/simple_icons_black/Twitter.png">';
  echo '</a>';
  echo '</li>';
  echo '<li>';
  echo '<a href="http://www.reddit.com/submit?url=http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F&title=Show%20your%20support%20for%20Virtual%20Rival" target="_blank" title="Submit to Reddit"><img src="images/simple_icons_black/Reddit.png">';
  echo '</a>';
  echo '</li>';
  echo '<li>';
  echo  '<a href="mailto:?subject=Show%20your%20support%20for%20Virtual%20Rival&body=Let%20us%20show%20our%20support%20for%20Virtual%20Rival%20by%20changing%20our%20facebook%20profile%20picture:%20http%3A%2F%2Fwww.virtualrival.mainsusl.com%2F" target="_blank" title="Email">';
  echo  '<img src="images/simple_icons_black/Email.png">';
  echo '</a>';
  echo '</li>';
  echo '</ul>';
  echo '</div>';


  echo '</div>';
  echo '</div>';

echo '</body>';


//echo '<img src="image.php" style="height:600px;width:600px" />';

}

echo '<br><br><a href="logout.php">Logout</a>';

 ?>
