<?php
/**
 * @author Robin D
 * Date: 04/04/22
 * Time: 11:26 AM
 */


$key = 'AIzaSyA0Dn97nzUo_z2Gg3gYy_zV3rGg9ibczZc';
$json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key={$key}&components=postal_code:82930");
$json = json_decode($json);
echo "<pre>";
echo "By ZIPCODE ONLY";
var_dump($json);
echo "</br>";
echo "</br>";
echo "</br>";


$address = urlencode("4777 City Center Parkway, Port Orange, Florida, 32129");
$googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$key}";
$geocodeResponseData = file_get_contents($googleMapUrl);
$responseData = json_decode($geocodeResponseData, true);
echo "By Full Address";
echo "</br>";
var_dump($responseData);