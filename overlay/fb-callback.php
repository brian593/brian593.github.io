<?php
session_start();
include_once(__DIR__.'/vendor/autoload.php');

$fb = new \Facebook\Facebook([
  'app_id' => '819360642543487',
  'app_secret' => '67d2ab2394dcf849e67d37d5b16eddbc',
  'default_graph_version' => 'v2.9',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // There was an error communicating with Graph
  echo 'Please try again!';
  //echo $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // User authenticated your app!
  // Save the access token to a session and redirect
  $_SESSION['access_token'] = (string) $accessToken;
  // Log them into your web framework here . . .
  // Redirect here . . .
  header('Location: http://www.virtualrival.mainsusl.com');
  exit;
} elseif ($helper->getError()) {
  // The user denied the request
  // You could log this data . . .
  // var_dump($helper->getError());
  // var_dump($helper->getErrorCode());
  // var_dump($helper->getErrorReason());
  // var_dump($helper->getErrorDescription());
  // You could display a message to the user
  // being all like, "What? You don't like me?"
  echo 'Please try again!';
  exit;
}

// If they've gotten this far, they shouldn't be here
http_response_code(400);
exit;
