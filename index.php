<?php
ini_set('display_errors', 1);
require_once('lib/TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "88411215-GZ6mCAXNc5CsJ16YdZSIrHWgH5lGH2GxUitpM7frU",
    'oauth_access_token_secret' => "IGWF2gVMHwgC0qnqv9IrSiGrsBoZZG4Xu6Ev0we42uwIA",
    'consumer_key' => "oGUq5UMqAi4tIz5JVscYQ",
    'consumer_secret' => "yCGSX6tlZMfLHstQtkC0kEioHsUxLrlqvZJrrS2YE"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'athantrinidad', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response 
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();
**/
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); 
$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?screen_name=athantrinidad';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo "<pre>".$twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest() . "</pre>";
 * **/
 

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=AngPoetNyo';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);

$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

echo "<pre>";
print_r(json_decode($response));
echo "</pre>";