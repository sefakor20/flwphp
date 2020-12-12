<?php

// start the session

use Facebook\Facebook;

session_start();

// include autoload file from vendor folder
require './vendor/autoload.php';
require './config.php';

$fb = new \Facebook\Facebook([
  'app_id' => $key['app_id'],
  'app_secret' => $key['app_secret'],
  'default_graph_version' => 'v2.7'
]);

$helper = $fb->getRedirectLoginHelper();
// login ulr
$login_url = $helper->getLoginUrl("http://localhost/codes/tut/social-logins/facebook/");

try {
  // get access token from fb
  $accessToken = $helper->getAccessToken();

  // check if access token is ready
  if (isset($accessToken)) {
    // convert access token to string
    $_SESSION['access_token'] = (string)$accessToken;

    // check is session is set and redirect to the user page or dashboard
    header('Location: ./index.php');
  }

} catch (Exception $e) {
  echo $e->getTraceAsString();
}


// get all information about user
if (isset($_SESSION['access_token'])) {
  try {

    $fb->setDefaultAccessToken($_SESSION['access_token']);
    $res = $fb->get('/me?locale=en_US&fields=name,email');
    $user = $res->getGraphUser();
    echo 'Hello '.$user->getField('name');

  } catch (Exception $e) {
    echo $e->getTraceAsString();
  }
}