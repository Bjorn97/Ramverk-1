<?php

namespace Anax\View;

// echo "MOPED\n\n";
// var_dump($location->longitude);
// var_dump($location->latitude);
// exit;

?>
<div class="wrapper_w">
    <div class="center">
        <form class="ip-test" method="get">
            <legend>ip</legend>
            <input type="text" name="input"><br>
            <input type="submit" name="submit" value="validate"><br>
        <a href="<?= url("geoJson?input=8.8.8.8")?>">test 8.8.8.8,</a><br>
        <div class="wrapper_info">
        <div class="info1"><b>get:</b><p> Route to geoJson</p> </div>
        <div class="info1"><b>input:</b><p> IP - address</p> </div>
    </div>
    <div class="result">
        <?php 
            if ($forcast != "") {
                for ($i=0; $i < 8; $i++) {
                    $time = $forcast->{"daily"}->{"data"}[$i]->{"time"};
                    ?>
                    <?=gmdate("Y-m-d", $time);?><br>
                    <?=
                    $forcast->{"daily"}->{"data"}[$i]->{"summary"};?><br><?=
                    " with highest temprature being " . $forcast->{"daily"}->{"data"}[$i]->{"apparentTemperatureHigh"};?><br><?=
                    " and lowest being " . $forcast->{"daily"}->{"data"}[$i]->{"apparentTemperatureLow"};?><br><br><?php
                }
            }else {
                echo($res);
            }

         ?>
    </div>
    </div>
    <div
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 400px;
        width: 100%;
      }
    </style>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>

    
    <div id="map" class="map"></div>
    <script type="text/javascript">
      var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          center: ol.proj.fromLonLat([
              <?=$location->longitude ?? 39.03385 ?>,
              <?=$location->latitude ?? 125.75432 ?>
          ]),
          zoom: 10
        })
      });
    </script>

    </div>
    
</div>
