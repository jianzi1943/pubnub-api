<?php

require_once('Pubnub.php');

## ---------------------------------------------------------------------------
## USAGE:
## ---------------------------------------------------------------------------
#
# php ./Pubnub-Example.php
# php ./Pubnub-Example.php [PUB-KEY] [SUB-KEY] [SECRET-KEY] [CIPHER-KEY] [USE SSL]
#


## Capture Publish and Subscribe Keys from Command Line
$publish_key   = 'demo';
$subscribe_key = 'demo';
$secret_key    =  false;
$cipher_key =  "enigma";
$ssl_on        = false;

## ---------------------------------------------------------------------------
## Create Pubnub Object
## ---------------------------------------------------------------------------
$pubnub = new Pubnub( $publish_key, $subscribe_key, $secret_key, $cipher_key, $ssl_on );

## ---------------------------------------------------------------------------
## Define Messaging Channel
## ---------------------------------------------------------------------------
$channel = "hello_world";

## ---------------------------------------------------------------------------
## Publish Example
## ---------------------------------------------------------------------------
echo "Running publish\r\n";
$pubish_success = $pubnub->publish(array(
    'channel' => $channel,
    'message' => 'Pubnub Messaging API 1'
));
echo($pubish_success[0] . $pubish_success[1]);
echo "\r\n";
$pubish_success = $pubnub->publish(array(
    'channel' => $channel,
    'message' => 'Pubnub Messaging API 2'
));
echo($pubish_success[0] . $pubish_success[1]);
echo "\r\n";

## ---------------------------------------------------------------------------
## History Example
## ---------------------------------------------------------------------------
echo "Running history\r\n";
$history = $pubnub->history(array(
    'channel' => $channel,
    'limit'   => 2
));
echo($history);
echo "\r\n";

## ---------------------------------------------------------------------------
## Here_Now Example
## ---------------------------------------------------------------------------
echo "Running here_now\r\n";
$here_now = $pubnub->here_now(array(
    'channel' => $channel
));
var_dump($here_now);
echo "\r\n";

## ---------------------------------------------------------------------------
## Timestamp Example
## ---------------------------------------------------------------------------
echo "Running timestamp\r\n";
$timestamp = $pubnub->time();
echo('Timestamp: ' . $timestamp);
echo "\r\n";

## ---------------------------------------------------------------------------
## Presence Example
## ---------------------------------------------------------------------------
echo("\nWaiting for Presence message... Hit CTRL+C to finish.\n");

$pubnub->presence(array(
    'channel'  => $channel,
    'callback' => function($message) {
        echo($message);
		echo "\r\n";
        return false;
    }
));

## ---------------------------------------------------------------------------
## Subscribe Example
## ---------------------------------------------------------------------------
echo("\nWaiting for Publish message... Hit CTRL+C to finish.\n");

$pubnub->subscribe(array(
    'channel'  => $channel,
    'callback' => function($message) {
        echo($message);
		echo "\r\n";
        return true;
    }
));

?>

