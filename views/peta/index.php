<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dektrium\user\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GpdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peta';
$this->params['breadcrumbs'][] = $this->title;

$all_users = User::find()->AsArray()->limit(500)->all();

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>

<div class="dashboard-index jumbotron2" style="background:#fff; border:1px solid #dcdcdc;">
	<div id="map" style="height: 400px;"></div>
</div>

<script type="text/javascript">

	var map = L.map('map').setView([-2, 117], 4);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(map);

	L.GeoIP = L.extend({

	    getPosition: function (ip) {
	        var url = "https://freegeoip.net/json/";
	        var result = L.latLng(0, 0);

	        if (ip !== undefined) {
	            url = url + ip;
	        } else {
	            //lookup our own ip address
	        }

	        var xhr = new XMLHttpRequest();
	        xhr.open("GET", url, false);
	        xhr.onload = function () {
	            var status = xhr.status;
	            if (status == 200) {
	                var geoip_response = JSON.parse(xhr.responseText);
	                result.lat = geoip_response.latitude;
	                result.lng = geoip_response.longitude;
	            } else {
	                console.log("Leaflet.GeoIP.getPosition failed because its XMLHttpRequest got this response: " + xhr.status);
	            }
	        };
	        xhr.send();
	        return result;
	    },

	    centerMapOnPosition: function (map, zoom, ip) {
	        var position = L.GeoIP.getPosition(ip);
	        map.setView(position, zoom);
	    }
	});

<?php
	for ($i=0; $i < count($all_users); $i++) { 
		echo "L.marker(L.GeoIP.getPosition('".$all_users[$i]["registration_ip"]."')).addTo(map).bindPopup('".$all_users[$i]["username"]."');
";
	}
?>
</script>
<div style="margin-top:20px;"></div>
