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
                $ApiKeys = new \Anax\ApiKeys\ApiKeys();
                return $ApiKeys;
            }
        ],
    ],
];
