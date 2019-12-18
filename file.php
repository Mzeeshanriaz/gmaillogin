<?php
require_once 'vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
  
  $client = new Google_Client();
  $client->setAuthConfigFile(FILE_PATH_GOOGLE_JSON);
  $client->addScope('email');
  $client->addScope('profile');
    
  if (! isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
  } else {
    $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
      $client->setAccessToken($token['access_token']);
    $google_service = new Google_Service_Oauth2($client);

    //Get user profile data from google
    $data = $google_service->userinfo->get(); 
   print_r($data);
  }
  ?>