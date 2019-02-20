<?php
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "key",
    'consumer_secret' => "key"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$user = 0;
$count = 1;

$user = "youtube";

if (isset($_GET['user'])) { $user = $_GET['user']; }

$users=array("youtube", "instagram", "foxnews", "nytimes", "CNN");

if (isset($users[$user])) {
    $user=$users[$user];
} else {
    $user = "youtube";
}

$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),$assoc = TRUE);

$array=array();

if(isset($string["errors"][0]["message"])) {
    //echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
    echo $array["error"]=$string[errors][0]["message"];
    echo json_encode($array);
    exit();
}

foreach($string as $items)
    {
        $array["text"]=$items["text"];
        $array["date"]=$items["created_at"];
        $array["user"]=$items['user']['name'];
        $array["user_link"]=$items["user"]["screen_name"];
        /*echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";*/
    }

echo json_encode($array);
?>