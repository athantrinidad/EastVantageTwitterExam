<?php
require_once('lib/TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$twitterSettings = array(
    'oauth_access_token' => TW_OATH_TOKEN,
    'oauth_access_token_secret' => TW_OATH_TOKEN_SECRET,
    'consumer_key' => TW_CONSUMER_KEY,
    'consumer_secret' => TW_CONSUMER_SECRET
);


class TwitterGet{
    protected $twitterSettings;

    public function __construct() {
        global $twitterSettings;
        $this->glob =& $twitterSettings;
    }

    public function getGlob() {
        return $this->glob['consumer_secret'];
    }
    
    public function getUserTweets(){
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$_GET['twitterUsername'].'&count=200';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->glob);

        return json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest());
    }
}

?>