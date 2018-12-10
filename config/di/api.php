<?php
/**
 * Configuration file to add as service in the Di container.
 */
return [

    // Services to add to the container.
    "services" => [
        "api" => [
            "shared" => true,
            "callback" => function () {
                $apikeys = new \Anax\apikeys\apikeys();
                return $apikeys;
            }
        ],
    ],
];
