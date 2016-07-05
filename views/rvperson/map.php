<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use kartik\label\LabelInPlace;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
/**
 * Created by PhpStorm.
 * User: ichie
 * Date: 27/6/2016
 * Time: 10:15 μμ
 */
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        body, html{
            height: 100%;
            width: 100%;
        }
        #map2 {
            height: 100%;
        }
    </style>



<?php
$gps=$model->gps;
$lat='37.983643';//athens
$lon='23.730104';
if($gps){
    $ex=explode(',',$gps);
    $lat=$ex[0];
    $lon=$ex[1];
}else{
    
}


?>
<script>
    var map;
    var lat=parseFloat('<?php echo $lat?>');
    var lon=parseFloat('<?php echo $lon?>');

    var myLatLng = {lat: lat, lng: lon};
 //   lat=parseFloat(lat);
   // lon=parseFloat(lon);
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat:lat, lng: lon},
            zoom: 16
        });
        var contentString ='<?php echo $model->firstname.' '.$model->lastname.'<br>'.$model->mobilephone;?>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',

        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIag5Rjp4335igKX52OTPVPcHARkzE6h0&callback=initMap"
        async defer></script>

<div id="map" style="height:500px;width:600px;"></div>

</body>
</html>