<?php

$friend_id = $_GET['user_id'];

require_once('AppInfo.php');
if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}
require_once('utils.php');
require_once('sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => true,
  'trustForwarded' => true,
));

$user_id = $facebook->getUser();
if ($user_id) {
  try {
    // Fetch the viewer's basic information
    $basic = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    // If the call fails we check if we still have a user. The user will be
    // cleared if the error is because of an invalid accesstoken
    if (!$facebook->getUser()) {
      header('Location: '. AppInfo::getUrl($_SERVER['REQUEST_URI']));
      exit();
    }
  }
  // This fetches 4 of your friends.
  $friends = idx($facebook->api('/me/friends'), 'data', array());
  $friends_of_friend = NULL;
  foreach($friends as $friend){
    //echo idx($friend,'name')."\n";
    if(idx($friend,'id')==$friend_id)
    {
        $friends_of_friend = idx($friend,'friends');
        echo 'achou';
        break;
    }
  }
  if ($friends_of_friend==NULL)
  {
    echo 'porcaria ta nula';
  }
  foreach($friends_of_friend as $n) echo idx($n,'name');

}

echo $user_id;

// Fetch the basic info of the app that they are using
$app_info = $facebook->api('/'. AppInfo::appID());

$app_name = idx($app_info, 'name', '');

?>