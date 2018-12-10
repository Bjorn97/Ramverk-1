<?php

return [
    "routes" => [
        [
            "info" => "GeoIPJson",
            "mount" => "geoJson",
            "handler" => "\Anax\Controller\GeoControllerJson",
        ],
    ]
];
