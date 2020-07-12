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
                        "range" => [
                            "user_id" => [
                                "gte" => 1,
                                "lte" => 100
                            ]
                        ],
                    ],
                    [
                        "range" => [
                            "user_id" => [
                                "gte" => 200,
                                "lte" => 400
                            ]
                        ],
                    ]
                ],
                "must" => [
                    [
                        "term" => [
                            "tag" => "渣男"
                        ],
                    ],
                    [
                        "match" => [
                            "description" => "trust life"
                        ]
                    ]
                ]
            ]
        ]
    ]
]);

var_dump($list);
exit;