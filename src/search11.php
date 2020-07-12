<?php
require_once "vendor/autoload.php";

$client = \Elasticsearch\ClientBuilder::create()->setHosts(
    [
        "127.0.0.1:9200",
    ]
)->build();

$list = $client->search([
    "type" => "_doc",
    "index" => "user",
    "body" => [
        "query" => [
            "bool" => [
                "should" => [
                    [
                        "term" => [
                            "mail" => "MGyY5VRs9r@mail.com"
                        ]
                    ],
                    [
                        "term" => [
                            "mail" => "WvJTELTX9d@mail.com"
                        ]
                    ]
                ]
            ]
        ]
    ]
]);

var_dump($list);
exit;